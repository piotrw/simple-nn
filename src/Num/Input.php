<?php
declare(strict_types=1);

namespace SimpleNN\Num;

class Input
{
    /**
     * @param $input
     * @return bool
     */
    public static function isScalar($input): bool
    {

        return is_numeric($input);
    }

    /**
     * @param $input
     * @return bool
     */
    public static function isVector($input): bool
    {
        if(!is_array($input)) {

            return false;
        }

        // the size of the first item
        $size = is_array($input[0]) ? sizeof($input[0]) : 0;
        foreach ($input as $item) {
            if(!self::isScalar($item) || $size > 0) {
                // column vector is allowed
                if(is_array($item) && sizeof($item) === $size && $size === 1) {
                    continue;
                }

                return false;
            }
        }

        return true;
    }

    /**
     * @param $input
     * @return bool
     */
    public static function isMatrix($input): bool
    {
        if(!is_array($input) || !is_array($input[0])) {

            return false;
        }

        $rowSize = sizeof($input[0]);
        foreach ($input as $item) {
            if(!self::isVector($item) || sizeof($item) !== $rowSize) {

                return false;
            }
        }

        return true;
    }

    /**
     * @param $input
     * @return bool
     */
    public static function isTensor($input): bool
    {
        if(!is_array($input) || !is_array($input[0])) {

            return false;
        }

        $rowSize = sizeof($input[0]);
        foreach ($input as $item) {
            if(!self::isMatrix($item) || sizeof($item) !== $rowSize) {

                return false;
            }
        }

        return true;
    }

    /**
     * @param $input
     * @return array|int
     */
    public static function shape($input) : array
    {
        switch (true) {
            case self::isScalar($input) :

                return [0];
            case self::isVector($input) :

                # 1D Array, Vector
                return [
                    sizeof($input)
                ];
            case self::isMatrix($input) :

                # 2D Array, Matrix
                return [
                    sizeof($input),
                    sizeof($input[0])
                ];
            case self::isTensor($input) :

                # 3D Array, Tensor
                return [
                    sizeof($input),
                    sizeof($input[0]),
                    sizeof($input[0][0])
                ];
            default:
                return sizeof($input, COUNT_RECURSIVE);
        }
    }

}