<?php

namespace SimpleNN\Activation;

class Step implements ActivationInterface
{
    /**
     * @var mixed
     */
    protected $output = [];

    public function forward(array $inputs)
    {
        $this->output = array_map(function ($value) {
            if(is_array($value)) {
                return $this->forward($value);
            }

            return $value > 0 ? 1 : 0;
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