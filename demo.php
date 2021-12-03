<?php

use NumPHP\Core\NumArray;
use SimpleNN\Activation;
use SimpleNN\Layer;

require_once "vendor/autoload.php";

// Input data
$X = [
    [1, 2, 3, 2.5],
    [2, 5, -1, 2],
    [-1.5, 2.7, 3.3, -0.8],
];

// Initialize pseudo-random generator, for testing
srand(0);

// Define layers and activation functions
$layer1 = new Layer(4, 5);
$layer2 = new Layer(5, 2);
$activation1 = new Activation\ReLU();
$activation2 = new Activation\ReLU(); // todo SoftPlus

// Forward network
$layer1->forward($X);
$activation1->forward($layer1->getOutput());
$layer2->forward($activation1->getOutput());
$activation2->forward($layer2->getOutput());

// display output of network
echo new NumArray($activation2->getOutput());
