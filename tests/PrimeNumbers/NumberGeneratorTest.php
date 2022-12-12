<?php

namespace Oesteve\Test\PrimeNumbers;

use Oesteve\PrimeNumbers\NumberGenerator;
use PHPUnit\Framework\TestCase;

final class NumberGeneratorTest extends TestCase
{
    public function testGenerateEmptyList(): void
    {
        $numbers = iterator_to_array(NumberGenerator::generateNumbers(0));
        $this->assertEquals([], $numbers);
    }

    public function testGenerateNumbers(): void
    {
        $numbers = iterator_to_array(NumberGenerator::generateNumbers(3));
        $this->assertEquals([1, 2, 3], $numbers);
    }

    public function testInvalidArgumentForNegativeNumbers(): void
    {
        $this->expectExceptionMessage('Length must be positive');
        $this->expectException(\InvalidArgumentException::class);

        NumberGenerator::generateNumbers(-5)->current();
    }
}
