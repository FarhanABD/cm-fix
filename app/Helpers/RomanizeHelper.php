<?php

namespace App\Helpers;

class RomanizeHelper
{
    protected static $lookup = [
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1,
    ];

    public static function romanize($number)
    {
        if ($number <= 0 || $number >= 4000) {
            throw new \InvalidArgumentException("Number out of range");
        }

        $result = '';
        foreach (self::$lookup as $roman => $value) {
            while ($number >= $value) {
                $result .= $roman;
                $number -= $value;
            }
        }

        return $result;
    }
}