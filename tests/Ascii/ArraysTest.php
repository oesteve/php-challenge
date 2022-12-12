<?php

namespace Oesteve\Test\Ascii;

use Oesteve\Ascii\Arrays;
use PHPUnit\Framework\TestCase;

final class ArraysTest extends TestCase
{
    public function testRandomize(): void
    {
        $array = [1, 2, 3, 4];
        $random = Arrays::randomise($array);

        $this->assertContains(1, $random);
        $this->assertContains(2, $random);
        $this->assertContains(3, $random);
        $this->assertContains(4, $random);
    }

    public function testRemoveRandomElement(): void
    {
        $array = [1, 2, 3, 4];
        [$res, $removedElement] = Arrays::removeElementRandom($array);

        $this->assertCount(3, $res);
        $this->assertNotContains($removedElement, $res);
    }

    public function testFindMissing(): void
    {
        $a = [1, 2, 3, 4];
        $b = [1, 2, 3];

        $missed = Arrays::findMissing($a, $b);

        $this->assertEquals(4, $missed);
    }

    public function testFindMissingWhenAreSimilar(): void
    {
        $a = [1];
        $b = [1];

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Arrays are similar');

        Arrays::findMissing($a, $b);
    }
}
