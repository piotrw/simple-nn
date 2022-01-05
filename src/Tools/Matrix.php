<?php

namespace SimpleNN\Tools;


use SimpleNN\Exception\InvalidArgumentException;
use SimpleNN\Num\Add;
use SimpleNN\Num\Dot;

class Matrix
{
    const AXIS_NONE = null;
    const AXIS_0 = 0;
    const AXIS_1 = 1;

    /**
     * Print scalar, vector, matrix or tensor
     * @param $array
     */
    public static function print($array)
    {
        if(!is_array($array)) {
            print $array . PHP_EOL;

            return;
        }

        print self::printRecursive($array) . PHP_EOL;
    }

    /**
     * @param $array
     * @param int $level
     * @return string
     */
    protected static function printRecursive($array, $level = 1): string
    {
        $level++;
        $offset = '';
        $separator = ', ';

        if(!$array || !is_array($array[0])) {

            return sprintf('[%s]', implode($separator, $array));
        }

        $row = null;
        foreach ($array as $sub) {
            if(is_array($sub)) {
                $separator = ', ' . PHP_EOL;
                $offset = $row ? str_pad('', $level - 1, ' ') : null;
            }
            $row .= $offset . self::printRecursive($sub, $level) . $separator;
        }

        return sprintf('[%s]', rtrim($row, $separator));
    }

    /**
     * Return a new array of given shape and type, filled with random  in the range of (-1, 1)
     * @param int $rows
     * @param int $cols
     * @return array
     */
    public static function randn(int $rows, int $cols): array
    {
        $output = Matrix::zeros($rows, $cols);
        for ($i = 0; $i < count($output); $i++) {
            for ($j = 0; $j < count($output[0]); $j++) {
                $output[$i][$j] = (lcg_value() - 0.5) * 2;
            }
        }

        return $output;
    }

    /**
     * Return a new array of given shape and type, filled with zeros
     * @param int $rows
     * @param int $cols
     * @return array
     */
    public static function zeros(int $rows, int $cols = 0): array
    {
        $content = 0;
        if($cols) {
            $content = array_fill(0, $cols, 0);
        }

        return array_fill(0, $rows, $content);
    }

    /**
     * @param int $rows
     * @param int $cols
     * @return array
     */
    public static function ones(int $rows, int $cols = 0): array
    {
        $content = 1;
        if($cols) {
            $content = array_fill(0, $cols, 1);
        }

        return array_fill(0, $rows, $content);
    }

    /**
     * Translates slice arrays to concatenation along the second axis.
     *
     * @param $array1
     * @param $array2
     * @return array
     */
    public static function _c($array1, $array2): array
    {
        return array_map(fn($i, $j) => [$i, $j], $array1, $array2);
    }

    /**
     * @param array $inputs
     * @param array $weights
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function dot(array $inputs, array $weights)
    {
        return Dot::dot($inputs, $weights);
    }

    /**
     * @param array $result
     * @param array $biases
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function add(array $result, array $biases)
    {
        return Add::add($result, $biases);
    }
}