<?php

namespace GmoInnovationAndTechnorogy\Triangle;

/**
 * 三角形の判定クラス
 */
class Triangle
{
    /**
     * @var int
     */
    private static $NUM_OF_SIDES = 3;

    /**
     * 3辺の長さから三角形の種類を返却する
     *
     * @param array $sides
     *
     * @throws \InvalidArgumentException
     */
    public static function judgeTriangleWithSidesArray($sides)
    {
        self::isValidTriangle($sides);
        return self::describeTriangleType($sides);
    }

    
    /**
     * 入力パラメーターのチェックを行う
     *
     * @param array $sides
     *
     * @throws \InvalidArgumentException
     */
    private static function isValidTriangle($sides)
    {
        if (count($sides) != self::$NUM_OF_SIDES) {
            throw new \InvalidArgumentException("Invalid args.", 100);
        }
        foreach ($sides as $i => $side) {
            if (!is_int($side)) {
                throw new \InvalidArgumentException("Invalid args.", 100);
            }
            if ($side <= 0) {
                throw new \InvalidArgumentException("Invalid args.", 100);
            }

            if ($side + $sides[($i + 1) % self::$NUM_OF_SIDES] <= $sides[($i + 2) % self::$NUM_OF_SIDES]) {
                throw new \InvalidArgumentException("Invalid triangle.", 100);
            }
        }
    }


    /**
     * 3辺の長さから三角形の種類を返却する
     *
     * @param array $sides
     *
     * @return string
     */
    private static function describeTriangleType($sides)
    {
        $equal_count = 0;
        foreach ($sides as $i => $side) {
            if ($side == $sides[($i + 1) % self::$NUM_OF_SIDES]) {
                $equal_count++;
            }
        }

        switch ($equal_count) {
            case 3:
                return "a regular triangle";
            case 1:
                return "a isoscales triangle";
            default:
                return "a scalene triangle";
        }
    }
}
