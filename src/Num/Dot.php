<?php
declare(strict_types=1);

namespace SimpleNN\Num;

use SimpleNN\Exception\InvalidArgumentException;
use SimpleNN\Tools\Matrix;

class Dot
{
    /**
     * @param $input1
     * @param $input2
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function dot($input1, $input2)
    {
        switch (true) {
            case Input::isScalar($input1) && Input::isScalar($input2) :
                return $input1 * $input2;
            case Input::isVector($input1) && Input::isVector($input2) :
                return self::dotVectorVector($input1, $input2);
            case Input::isMatrix($input1) && Input::isMatrix($input2) :
                return self::dotMatrixMatrix($input1, $input2);
            // todo more...
            default:
                throw new InvalidArgumentException();
        }
    }

    /**
     * @param $input1
     * @param $input2
     * @return float
     * @throws InvalidArgumentException
     */
    protected static function dotVectorVector($input1, $input2): float
    {
        if (sizeof($input1) != sizeof($input2)) {

            throw new InvalidArgumentException(
                sprintf('Dot: The size of the two vectors is different (%s =/= %s)', sizeof($input1), sizeof($input2))
            );
        }

        $output = 0;
        foreach ($input1 as $i => $value) {
            $output += $value * $input2[$i];
        }

        return $output;
    }

    /**
     * @param $input1
     * @param $input2
     * @return array
     */
    protected static function dotMatrixMatrix($input1, $input2)
    {
        $output = Matrix::zeros(count($input1), count($input2[0]));

        for($i = 0; $i < count($output); $i++) {
            for($j = 0; $j < count($output[0]); $j++) {
                $sum = 0;
                for($k = 0; $k < count($input1[0]); $k++) {
                    $sum += $input1[$i][$k] * $input2[$k][$j];
                }
                $output[$i][$j] = $sum;
            }
        }

        return $output;
    }

}