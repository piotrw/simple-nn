<?php

namespace SimpleNN\Activation;

class LeakyReLU extends AbstractActivation
{

    /**
     * @inheritDoc
     */
    public function forward(array $inputs)
    {
        $this->output = array_map(function ($value) {
            if(is_array($value)) {
                return $this->forward($value);
            }

            return max(0.1 * $value, $value);
        }, $inputs);

        return $this->output;
    }
}