<?php

namespace App\Helpers;

final class MathHelper
{
    public static function bisector($a, $b)
    {
        if ($a == 0 && $b == 0) {
            return 0;
        }
        return (($a * $b)/($a + $b)) * sqrt(2);
    }
}