<?php

namespace SimpleNN\Activation;

/**
 * Binary Step Activation Function
 */
class Step extends AbstractActivation
{
    /**
     * @param array $inputs
     * @return array
     */
    public function forward(array $inputs): array
    {
        $this->output = array_map(function ($value) {
            if(is_array($value)) {
                return $this->forward($value);
            }

            return $value > 0 ? 1 : 0;
        }, $inputs);

        return $this->output;
    }
}