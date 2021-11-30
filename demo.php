<?php

use SimpleNN\Layer;

require_once "vendor/autoload.php";

$X = [
    [1, 2, 3, 2.5],
    [2, 5, -1, 2],
    [-1.5, 2.7, 3.3, -0.8],
];

srand(0);

$layer1 = new Layer(4, 5);
$layer2 = new Layer(5, 2);

$layer1->forward($X);
$layer2->forward($layer1->getOutput());

echo new \NumPHP\Core\NumArray($layer1->getOutput());