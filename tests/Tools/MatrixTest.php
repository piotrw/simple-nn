<?php

namespace Tools;

use SimpleNN\Tools\Matrix;
use PHPUnit\Framework\TestCase;

class MatrixTest extends TestCase
{

    public function testAdd()
    {
        $matrix = [[0, 1], [2, 3]];
        $vector = [1, 2];
        $this->assertSame([[1, 3], [3, 5]], Matrix::add($matrix, $vector));
    }
}
