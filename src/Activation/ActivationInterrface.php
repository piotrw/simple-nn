<?php

namespace SimpleNN\Activation;


/**
 * Activation
 */
interface ActivationInterrface
{
    /**
     * Activation
     *
     * @param array $inputs
     * @return array|array[]|mixed
     */
    public function forward(array $inputs);

    /**
     * @return mixed
     */
    public function getOutput();
}