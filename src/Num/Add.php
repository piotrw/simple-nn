<?php
declare(strict_types=1);

namespace SimpleNN\Num;

use SimpleNN\Exception\InvalidArgumentException;
use SimpleNN\Tools\Matrix;

class Add
{
    /**
     * @param $input1
     * @param $input2
     * @return float|int|mixed
     * @throws InvalidArgumentException
     */
    public static function add($input1, $input2)
    {
        switch (true) {
            case Input::isScalar($input1) && Input::isScalar($input2) :
                return $input1 + $input2;
            case Input::isVector($input1) && Input::isVector($input2) :
                return self::addVectorVector($input1, $input2);
            case Input::isMatrix($input1) && Input::isVector($input2) :
                return self::addMatrixVector($input1, $input2);
            // todo more...
            default:
                throw new InvalidArgumentException();
        }
    }

    /**
     * @param $input1
     * @param $input2
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected static function addVectorVector($input1, $input2)
    {
        if (sizeof($input1) != sizeof($input2)) {
            throw new InvalidArgumentException(
                sprintf('Add(): The size of the two vectors is different: (%s =/= %s)', sizeof($input1), sizeof($input2))
            );
        }

        $output = 0;
        foreach ($input1 as $i => $value) {
            $output += $value + $input2[$i];
        }

        return $output;
    }

    /**
     * @param $input1
     * @param $input2
     * @return array
     */
    protected static function addMatrixVector($input1, $input2): array
    {
        $output = Matrix::zeros(count($input1), count($input1[0]));

        for($i = 0; $i < count($input1); $i++) {
            for($j = 0; $j < count($input1[0]); $j++) {
                $output[$i][$j] = $input1[$i][$j] + $input2[$j];
            }
        }

        return $output;
    }
}