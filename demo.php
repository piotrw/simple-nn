<?php

use SimpleNN\Layer;

require_once "vendor/autoload.php";

$X = [
    [1, 1, 1, 1, 1],
    [1, 0, 0, 0, 1],
    [1, 0, 1, 0, 1],
    [1, 0, 0, 0, 1],
    [1, 1, 1, 1, 1],
];

srand(0);

$layer1 = new Layer(5, 10);
$layer2 = new Layer(10, 2);

$layer1->forward($X);
$layer2->forward($layer1->getOutput());

var_dump($layer2->getOutput());