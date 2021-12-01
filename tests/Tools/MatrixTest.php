<?php

namespace Tools;

use SimpleNN\Tools\Matrix;
use PHPUnit\Framework\TestCase;

class MatrixTest extends TestCase
{

    public function testAddRowVector()
    {
        $matrix = [[0, 1], [2, 3]];
        $rowVector = [1, 2];
        $this->assertSame([[1, 2], [4, 5]], Matrix::addRowVector($matrix, $rowVector));
    }

    public function testAddColumnVector()
    {
        $matrix = [[0, 1], [2, 3]];
        $columnVector = [1, 2];
        $this->assertSame([[1, 3], [3, 5]], Matrix::addColumnVector($matrix, $columnVector));
    }
}
