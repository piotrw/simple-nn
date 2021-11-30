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
    protected $output;

    /**
     * Layer constructor.
     * @param int $numberInputs
     * @param int $numberNeurons
     */
    public function __construct(int $numberInputs, int $numberNeurons)
    {
        $this->weights = new NumArray(Generate::generateArray([$numberInputs, $numberNeurons]));
        $this->biases = new NumArray(Generate::generateArray([1, $numberNeurons], 0)[0]);
    }

    /**
     * @param $inputs
     * @return array|mixed
     */
    public function oldForward($inputs): array
    {
        $inputs = new NumArray($inputs);

        $this->output = $inputs
            ->dot($this->weights)
            ->getTranspose()
            ->add($this->biases)
            ->getTranspose()
            ->getData();

        return $this->output;
    }

    /**
     * Forward method
     * todo benchmark this
     * @param $inputs
     * @return array|mixed
     */
    public function forward($inputs): array
    {
        $inputs = new NumArray($inputs);
        $this->output = $inputs->dot($this->weights);
        $this->output = Matrix::addVector($this->output, $this->biases);
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