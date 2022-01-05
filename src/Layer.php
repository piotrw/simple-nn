<?php
declare(strict_types=1);

namespace SimpleNN;


use SimpleNN\Tools\Matrix;

class Layer
{
    /**
     * @var array
     */
    protected array $weights;
    /**
     * @var array
     */
    protected array $biases;
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
        $this->weights = Matrix::randn($numberInputs, $numberNeurons);
        $this->biases = Matrix::ones($numberNeurons);
    }

    /**
     * Forward method
     * @param array $inputs
     * @return array|mixed
     * @throws Exception\InvalidArgumentException
     */
    public function forward(array $inputs): array
    {
        $result = Matrix::dot($inputs, $this->weights);
        $this->output = Matrix::add($result, $this->biases);
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