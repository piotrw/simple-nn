<?php

namespace SimpleNN\Tools;

/**
 * Dataset
 */
class Dataset
{
    /**
     * @var int dimensionality
     */
    protected int $dim = 2;

    /**
     * @var float[][] data matrix (each row = single example)
     */
    protected array $x;

    /**
     * @var int[] class labels
     */
    protected array $y;

    /**
     * Generating a classification dataset
     *
     * @param int $points   number of points per class
     * @param int $classes  number of classes
     */
    public function createData(int $points, int $classes)
    {
        $this->x = array_fill(0, $points * $classes, array_fill(0, $this->dim, 0));
        $this->y = array_fill(0, $points * $classes, 0);

        $ix = 0;
        for ($classNumber = 0; $classNumber < $classes; $classNumber++) {
            $radius = 0;
            $theta = $classNumber * 4;
            while ($radius <= 1 && (int)$theta <= ($classNumber + 1) * 4) {
                $randomTheta = $theta + lcg_value();
                $this->x[$ix][0] = $radius * sin($randomTheta * 2.5);
                $this->x[$ix][1] = $radius * cos($randomTheta * 2.5);
                $this->y[$ix] = $classNumber;
                $radius += 1 / ($points - 1);
                $theta += 4 / ($points - 1);
                $ix++;
            }
        }
    }

    /**
     * @return float[][]
     */
    public function getX(): array
    {
        return $this->x;
    }

    /**
     * @return int[]
     */
    public function getY(): array
    {
        return $this->y;
    }

}