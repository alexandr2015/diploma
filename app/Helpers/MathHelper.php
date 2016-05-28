<?php

namespace App\Helpers;

final class MathHelper
{
    public static function bisector($a, $b)
    {
        return (($a * $b)/($a + $b)) * sqrt(2);
    }
}