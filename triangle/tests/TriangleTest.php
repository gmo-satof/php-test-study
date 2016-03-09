<?php

namespace GmoInnovationAndTechnorogy\Triangle;

class TriangleTest extends \PHPUnit_Framework_TestCase
{

    /**
     * [無効] 入力値が足りない場合のテスト（0個）
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_empty()
    {
        self::assertVaridTriangleWithInput(array());
    }

    /**
     * [無効] 入力値が足りない場合のテスト（1個）
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_one_arg()
    {
        self::assertVaridTriangleWithInput(array(1));
    }

    /**
     * [無効] 入力値が足りない場合のテスト（2個）
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_two_args()
    {
        self::assertVaridTriangleWithInput(array(1,2));
    }


    /**
     * [無効] 入力値が整数でない場合のテスト（実数）
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_not_int()
    {
        self::assertVaridTriangleWithInput(array(0.1,0.2,0.3));
    }

    /**
     * [無効] 入力値が整数でない場合のテスト（文字）
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_char()
    {
        self::assertVaridTriangleWithInput(array('a','b','c'));
    }



    /**
     * [無効] 無効な入力境界値のテスト（入力1）
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_0_x_x()
    {
        self::assertVaridTriangleWithInput(array(0,1,3));
    }

    /**
     * [無効] 無効な入力境界値のテスト（入力2）
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_x_0_x()
    {
        self::assertVaridTriangleWithInput(array(1,0,3));
    }

    /**
     * [無効] 無効な入力境界値のテスト（入力3）
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidArgument_x_x_0()
    {
        self::assertVaridTriangleWithInput(array(1,1,0));
    }



    /**
     * [無効] 無効な三角形境界値のテストケース（a + b = c）
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidTriangle_1_and_2_equal_3()
    {
        self::assertVaridTriangleWithInput(array(1,2,3));
    }

    /**
     * [無効] 無効な三角形境界値のテストケース（b + c = a）
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidTriangle_2_and_3_equal_1()
    {
        self::assertVaridTriangleWithInput(array(3,1,2));
    }

    /**
     * [無効] 無効な三角形境界値のテストケース（c + a = b）
     * @expectedException     \InvalidArgumentException
     * @expectedExceptionCode 100
     */
    public function test_judgeTriangleWithSidesArray_invalidTriangle_3_and_1_equal_2()
    {
        self::assertVaridTriangleWithInput(array(2,3,1));
    }



    /**
     * [有効] 有効な入力境界値のテストケース（入力1）
     */
    public function test_judgeTriangleWithSidesArray_validTriangle_1_x_x()
    {
        self::assertVaridTriangleWithInput(array(1,2,2));
    }

    /**
     * [有効] 有効な入力境界値のテストケース（入力2）
     */
    public function test_judgeTriangleWithSidesArray_validTriangle_x_1_x()
    {
        self::assertVaridTriangleWithInput(array(2,1,2));
    }

    /**
     * [有効] 有効な入力境界値のテストケース（入力3）
     */
    public function test_judgeTriangleWithSidesArray_validTriangle_x_x_1()
    {
        self::assertVaridTriangleWithInput(array(2,2,1));
    }



    /**
     * [有効] 有効な三角形境界値のテストケース（a + b > c）
     */
    public function test_judgeTriangleWithSidesArray_validTriangle_1_and_2_more_then_3()
    {
        self::assertVaridTriangleWithInput(array(2,3,4));
    }

    /**
     * [有効] 有効な三角形境界値のテストケース（b + c > a）
     */
    public function test_judgeTriangleWithSidesArray_validTriangle_2_and_3_more_then_1()
    {
        self::assertVaridTriangleWithInput(array(4,2,3));
    }

    /**
     * [有効] 有効な三角形境界値のテストケース（c + a > b）
     */
    public function test_judgeTriangleWithSidesArray_validTriangle_3_and_1_more_then_2()
    {
        self::assertVaridTriangleWithInput(array(3,4,2));
    }



    /**
     * [有効] 不等辺三角形(a scalene triangle)のテストケース
     */
    public function test_judgeTriangleWithSidesArray_scaleneTriangle()
    {
        self::assertTriangleWithOutIn("a scalene triangle", array(3,4,5));
    }

    /**
     * [有効] 二等辺三角形(a isoscales triangle)のテストケース
     */
    public function test_judgeTriangleWithSidesArray_isoscalesTriangle()
    {
        self::assertTriangleWithOutIn("a isoscales triangle", array(5,5,4));
        self::assertTriangleWithOutIn("a isoscales triangle", array(4,5,5));
        self::assertTriangleWithOutIn("a isoscales triangle", array(5,4,5));
    }

    /**
     * [有効] 正三角形(a regular triangle)のテストケース
     */
    public function test_judgeTriangleWithSidesArray_regularTriangle()
    {
        self::assertTriangleWithOutIn("a regular triangle", array(3,3,3));
    }




    /**
     * Triangle::judgeTriangleWithSidesArray()の入力値評価に使うヘルパー関数
     */
    private static function assertVaridTriangleWithInput($in)
    {
        self::assertInternalType('string', Triangle::judgeTriangleWithSidesArray($in));
    }

    /**
     * Triangle::judgeTriangleWithSidesArray()の入出力評価に使うヘルパー関数
     */
    private static function assertTriangleWithOutIn($out, $in)
    {
        self::assertEquals($out, Triangle::judgeTriangleWithSidesArray($in));
    }
}
