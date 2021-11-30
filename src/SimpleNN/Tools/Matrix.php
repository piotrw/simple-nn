<?php

namespace SimpleNN\Tools;

use NumPHP\Core\NumArray;

class Matrix
{
    /**
     * Adds vector to Matrix
     * @param array|NumArray $matrix
     * @param array|NumArray $vector
     * @return array
     */
    public static function addVector($matrix, $vector): array
    {
        if($matrix instanceof NumArray) {
            $matrix = $matrix->getData();
        }

        return array_map(function ($input) use ($vector) {
            $np = new NumArray($input);
            return $np->add($vector)->getData();
        }, $matrix);
    }
}