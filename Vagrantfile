# -*- mode: ruby -*-
# vi: set ft=ruby :

$script = <<SCRIPT

yum -y install git wget
yum -y install yum-plugin-priorities

rpm -ivh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm
rpm --import http://rpms.famillecollet.com/RPM-GPG-KEY-remi
rpm -ivh http://mirrors.dotsrc.org/jpackage/6.0/generic/free/RPMS/jpackage-release-6-3.jpp6.noarch.rpm
rpm --import http://www.jpackage.org/jpackage.asc
wget -q -O /etc/yum.repos.d/jenkins.repo http://pkg.jenkins-ci.org/redhat/jenkins.repo
rpm --import http://pkg.jenkins-ci.org/redhat/jenkins-ci.org.key



### Template for Jenkins Jobs for PHP Projects
### http://jenkins-php.org/installation.html

### setup php and tools
yum -y install --enablerepo=remi-php56 php php-devel php-xml php-pecl-xdebug php-mbstring
sed -i -e "s@^;date.timezone =@date.timezone = Asia\/Tokyo@" /etc/php.ini

[ ! -f "/usr/bin/phpunit" ] && wget -nc -q https://phar.phpunit.de/phpunit.phar
[ ! -f "/usr/bin/phpcs" ] && wget -nc -q https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar
[ ! -f "/usr/bin/phploc" ] && wget -nc -q https://phar.phpunit.de/phploc.phar
[ ! -f "/usr/bin/pdepend" ] && wget -nc -q http://static.pdepend.org/php/latest/pdepend.phar
[ ! -f "/usr/bin/phpmd" ] && wget -nc -q http://static.phpmd.org/php/latest/phpmd.phar
[ ! -f "/usr/bin/phpcpd" ] && wget -nc -q https://phar.phpunit.de/phpcpd.phar
[ ! -f "/usr/bin/phpdox" ] && wget -nc -q http://phpdox.de/releases/phpdox.phar
[ ! -f "/usr/bin/phpab" ] && wget -nc -q https://github.com/theseer/Autoload/releases/download/1.21.0/phpab-1.21.0.phar
for file in *.phar; { [ -f $file ] && chmod +x $file && name=${file%%-*} && mv "$file" "/usr/bin/${name%%.*}"; }



### setup jenkins
yum -y --enablerepo=jpackage install ant
yum -y install java-1.7.0-openjdk java-1.7.0-openjdk-devel
yum -y --enablerepo=jenkins install jenkins

service jenkins start
chkconfig jenkins on

waitCount=0
until [ "`curl --silent --connect-timeout 1 -I http://localhost:8080 | egrep '200 OK'`" != "" ];
do
  if [ ${waitCount} -eq 20 ]; then
    echo "Can't connect to jenkins."
    exit 1
  fi
  echo "Waiting for jenkins is up..."
  waitCount=`expr ${waitCount} + 1`
  sleep 3
done

if [ ! -f "jenkins-cli.jar" ]; then
  wget -nc -q http://localhost:8080/jnlpJars/jenkins-cli.jar
fi

curl -sSL https://updates.jenkins-ci.org/update-center.json | sed '1d;$d' | curl -sS -X POST -H 'Accept: application/json' -d @- http://localhost:8080/updateCenter/byId/default/postBack > /dev/null
plugins=`java -jar jenkins-cli.jar -s http://localhost:8080 list-plugins`
array=("checkstyle" "cloverphp" "crap4j" "dry" "htmlpublisher" "jdepend" "plot" "pmd" "violations" "warnings" "xunit" "git")
i=0
for e in ${array[@]}; do
  if [ "`echo ${plugins} | grep ${e}`" == "" ]; then
    java -jar jenkins-cli.jar -s http://localhost:8080 install-plugin "${e}"
  else
    echo "jankins-plugin ${e} is already installed"
  fi
  let i++
done

if [ "`java -jar jenkins-cli.jar -s http://localhost:8080 list-jobs | grep triangle`" = "" ]; then
  #curl -sSL https://raw.githubusercontent.com/sebastianbergmann/php-jenkins-template/master/config.xml | java -jar jenkins-cli.jar -s http://localhost:8080 create-job triangle
  cat /vagrant/config.xml | java -jar jenkins-cli.jar -s http://localhost:8080 create-job triangle
else
  echo "jenkins-job triangle is already exists"
fi

if [ ! -d "/var/lib/jenkins/jobs/triangle/workspace" ]; then
  sudo -u jenkins mkdir /var/lib/jenkins/jobs/triangle/workspace
  sudo -u jenkins cp -frp /vagrant/triangle/build* /var/lib/jenkins/jobs/triangle/workspace/.
  sudo -u jenkins ln -s /vagrant/triangle/src /var/lib/jenkins/jobs/triangle/workspace/src
  sudo -u jenkins ln -s /vagrant/triangle/tests /var/lib/jenkins/jobs/triangle/workspace/tests
fi

#java -jar jenkins-cli.jar -s http://localhost:8080 reload-configuration
java -jar jenkins-cli.jar -s http://localhost:8080 safe-restart

SCRIPT




Vagrant.configure("2") do |config|
  config.vm.box = "centos65"
  config.vm.box_url = "https://github.com/2creatives/vagrant-centos/releases/download/v6.5.3/centos65-x86_64-20140116.box"
  config.vm.network :private_network, ip: "192.168.33.190"
  config.vm.provider "virtualbox" do |v|
    v.customize ["modifyvm", :id, "--memory", "512"]
  end
  config.vm.synced_folder ".", "/vagrant", owner: "vagrant", group: "vagrant"
  config.vm.provision "shell", inline: $script
end
