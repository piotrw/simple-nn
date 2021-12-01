<?php

namespace SimpleNN\Tools;

use NumPHP\Core\NumArray;

class Matrix
{
    /**
     * Adds row vector to Matrix
     *
     * @param array|NumArray $matrix
     * @param array|NumArray $vector
     * @return array
     */
    public static function addRowVector($matrix, $vector): array
    {
        if(!$matrix instanceof NumArray) {
            $matrix = new NumArray($matrix);
        }

        return $matrix->add($vector)->getData();
    }

    /**
     * Adds column vector to Matrix
     *
     * @param array|NumArray $matrix
     * @param array|NumArray $vector
     * @return array
     */
    public static function addColumnVector($matrix, $vector): array
    {
        if($matrix instanceof NumArray) {
            $matrix = $matrix->getData();
        }

        return array_map(function ($row) use ($vector) {
            $np = new NumArray($row);
            return $np->add($vector)->getData();
        }, $matrix);
    }
}