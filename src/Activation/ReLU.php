<?php

namespace SimpleNN\Activation;

use NumPHP\Core\NumArray;
use NumPHP\Core\NumPHP;
use SimpleNN\Tools\Matrix;

/**
 * ReLU - Rectified Linear Unit
 */
class ReLU implements ActivationInterrface
{
    /**
     * @var mixed
     */
    protected $output = [];

    /**
     * Activation
     *
     * @param array $inputs
     * @return array|array[]|mixed
     */
    public function forward(array $inputs)
    {
        $this->output = array_map(function ($value) {
            if(is_array($value)) {
                return $this->forward($value);
            }

            return max(0, $value);
        }, $inputs);

        return $this->output;
    }

    /**
     * @return mixed
     */
    public function getOutput()
    {
        return $this->output;
    }
}