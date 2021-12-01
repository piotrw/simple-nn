<?php


namespace SimpleNN;


use NumPHP\Core\NumArray;
use NumPHP\Core\NumPHP\Generate;
use SimpleNN\Tools\Matrix;

class Layer
{
    /**
     * @var NumArray
     */
    protected NumArray $weights;
    /**
     * @var NumArray
     */
    protected NumArray $biases;
    /**
     * @var mixed
     */
    protected $output = [];

    /**
     * Layer constructor.
     * @param int $numberInputs
     * @param int $numberNeurons
     */
    public function __construct(int $numberInputs, int $numberNeurons)
    {
        $this->weights = new NumArray(Generate::generateArray([$numberInputs, $numberNeurons]));
        $this->biases = new NumArray(Generate::generateArray([1, $numberNeurons], 1)[0]);
    }

    /**
     * Forward method
     * @param array $inputs
     * @return array|mixed
     */
    public function forward(array $inputs): array
    {
        $inputs = new NumArray($inputs);
        $inputs->dot($this->weights);
        $this->output = Matrix::addColumnVector($inputs, $this->biases);
        return $this->output;
    }

    /**
     * @return array
     */
    public function getOutput(): array
    {
        return $this->output;
    }
}