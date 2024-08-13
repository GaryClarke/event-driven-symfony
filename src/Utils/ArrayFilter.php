<?php

declare(strict_types=1);

namespace App\Utils;

class ArrayFilter
{
    public static function removeEmptyKeysRecursively(array &$array): void
    {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                static::removeEmptyKeysRecursively($value);
            }
            if ($value === null || $value === '') {
                unset($array[$key]);
            }
        }
    }
}
