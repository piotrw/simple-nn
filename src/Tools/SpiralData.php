<?php

namespace SimpleNN\Tools;

use NumPHP\Core\Exception\InvalidArgumentException;
use NumPHP\Core\Exception\MissingArgumentException;
use NumPHP\Core\NumPHP;

/**
 * SpiralData
 *
 * https://cs231n.github.io/neural-networks-case-study/
 */
class SpiralData
{
    /**
     * @var int number of points per class
     */
    protected int $points;

    /**
     * @var int number of classes
     */
    protected int $classes;

    /**
     * @var int dimensionality
     */
    protected int $dim = 2;

    /**
     * @var mixed data matrix (each row = single example)
     */
    protected $x;

    /**
     * @var mixed class labels
     */
    protected $y;

    /**
     * @param $points
     * @param $classes
     */
    public function __construct($points, $classes)
    {
        $this->points = $points;
        $this->classes = $classes;
    }

    /**
     * Generating a classification dataset
     *
     * @return array
     * @throws InvalidArgumentException|MissingArgumentException
     */
    public function generate(): array
    {
        $this->x = NumPHP::zeros($this->points * $this->classes, $this->dim);
        $this->y = NumPHP::zeros($this->points * $this->classes);

        foreach (range(0, $this->classes - 1) as $classNumber) {
            $ix = $this->points * $classNumber . ':' . $this->points * ($classNumber + 1);
            $radius = NumPHP::linspace(0, 1, $this->points);
            $theta = NumPHP::linspace(
                $classNumber * 4, ($classNumber + 1) * 4, $this->points
            )->add(
                NumPHP::rand($this->points)->mult(0.2)
            );

            $this->x->set($ix,
                Matrix::_c(
                    $radius->mult($theta->map(fn($t) => sin($t) * 2.5))->getData(),
                    $radius->mult($theta->map(fn($t) => cos($t) * 2.5))->getData()
                ));
            $this->y->set($ix, array_fill(0, $this->points, $classNumber));
        };

        return [$this->x->getData(), $this->y->getData()];
    }

}