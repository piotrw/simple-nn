<?php

namespace Tools;

use SimpleNN\Num\Input;
use PHPUnit\Framework\TestCase;

class InputTest extends TestCase
{

    public function testIsMatrix()
    {
        $this->assertTrue(Input::isMatrix([[1, 2], [3, 3]]));
        $this->assertTrue(Input::isMatrix([[1, 2], [3, 3], [4, 5]]));
        $this->assertTrue(Input::isMatrix([[1], [2], [3], [3]]));

        $this->assertFalse(Input::isMatrix([[1, 2], [3]]));
        $this->assertFalse(Input::isMatrix([[1, 2], [3, [3]]]));
        $this->assertFalse(Input::isMatrix([1, 2]));
        $this->assertFalse(Input::isMatrix('a'));
        $this->assertFalse(Input::isMatrix(1));
    }

    public function testIsVector()
    {
        $this->assertTrue(Input::isVector([1]));
        $this->assertTrue(Input::isVector([1, 2]));
        $this->assertTrue(Input::isVector([[1], [2]]));
        $this->assertFalse(Input::isVector([1, 2, [3]]));
        $this->assertFalse(Input::isVector([[1, 2], [3, 4]]));
        $this->assertFalse(Input::isVector('a'));
        $this->assertFalse(Input::isVector(1));

    }

    public function testIsScalar()
    {
        $this->assertTrue(Input::isScalar(1));
        $this->assertTrue(Input::isScalar(1.2));
        $this->assertTrue(Input::isScalar(-3.4));
        $this->assertFalse(Input::isScalar('a'));
        $this->assertFalse(Input::isScalar([1]));
    }
}
