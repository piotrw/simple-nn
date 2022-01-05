<?php

namespace SimpleNN\Activation;

use SimpleNN\Activation\ActivationInterface;

abstract class AbstractActivation implements ActivationInterface
{
    /**
     * @var mixed
     */
    protected $output = [];

    /**
     * @return array
     */
    public function getOutput(): array
    {
        return $this->output;
    }
}