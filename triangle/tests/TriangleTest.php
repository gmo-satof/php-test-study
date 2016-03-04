<?php

namespace GmoInnovationAndTechnorogy\Triangle;

class TriangleTest extends \PHPUnit_Framework_TestCase
{

    /**
     * A regular triangle
     */
    public function test_judgeTriangleWithSidesArray_regularTriangle()
    {
        self::assertTriangleWithOutIn("a regular triangle", array(3,3,3));
    }

    /**
     * A isoscales triangle
     */
    public function test_judgeTriangleWithSidesArray_isoscalesTriangle()
    {
        self::assertTriangleWithOutIn("a isoscales triangle", array(5,5,4));
        self::assertTriangleWithOutIn("a isoscales triangle", array(4,5,5));
        self::assertTriangleWithOutIn("a isoscales triangle", array(5,4,5));
    }

    /**
     * A scalene triangle
     */
    public function test_judgeTriangleWithSidesArray_scaleneTriangle()
    {
        self::assertTriangleWithOutIn("a scalene triangle", array(2,4,3));
    }


    /**
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_0_x_x()
    {
        self::assertTriangleWithOutIn("", array(0,1,3));
    }

    /**
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_x_0_x()
    {
        self::assertTriangleWithOutIn("", array(1,0,3));
    }

    /**
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_x_x_0()
    {
        self::assertTriangleWithOutIn("", array(1,1,0));
    }


    /**
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_empty()
    {
        self::assertTriangleWithOutIn("", array());
    }

    /**
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_one_arg()
    {
        self::assertTriangleWithOutIn("", array(1));
    }

    /**
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_two_args()
    {
        self::assertTriangleWithOutIn("", array(1,2));
    }



    /**
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_0_0_0()
    {
        self::assertTriangleWithOutIn("", array(0,0,0));
    }

    /**
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_not_int()
    {
        self::assertTriangleWithOutIn("", array(0.1,0.2,0.3));
    }

    /**
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_char()
    {
        self::assertTriangleWithOutIn("", array('a','b','c'));
    }


    /**
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidTriangle_1_and_2_less_3()
    {
        self::assertTriangleWithOutIn("", array(1,1,3));
    }

    /**
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidTriangle_2_and_3_less_1()
    {
        self::assertTriangleWithOutIn("", array(3,1,1));
    }

    /**
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidTriangle_3_and_1_less_2()
    {
        self::assertTriangleWithOutIn("", array(1,3,1));
    }

    /**
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidTriangle_1_and_2_equal_3()
    {
        self::assertTriangleWithOutIn("", array(1,2,3));
    }

    /**
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidTriangle_2_and_3_equal_1()
    {
        self::assertTriangleWithOutIn("", array(3,1,2));
    }

    /**
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidTriangle_3_and_1_equal_2()
    {
        self::assertTriangleWithOutIn("", array(2,3,1));
    }



    /**
     * Helper function for judgeTriangleWithSidesArray
     */
    private static function assertTriangleWithOutIn($out, $in)
    {
        self::assertEquals($out, Triangle::judgeTriangleWithSidesArray($in));
    }

}
