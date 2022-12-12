<?php

namespace Oesteve\Test\PrimeNumbers;

use Oesteve\PrimeNumbers\Integer;
use PHPUnit\Framework\TestCase;

final class IntegerTest extends TestCase
{
    public function testGetOneMultipliers(): void
    {
        $this->assertEquals([], Integer::divisors(1));
    }

    public function testGetTwelveMultipliers(): void
    {
        $this->assertEquals([2, 3, 4, 6], Integer::divisors(12));
    }

    public function testGetHundredMultipliers(): void
    {
        $this->assertEquals([2, 4, 5, 10, 20, 25, 50], Integer::divisors(100));
    }
}
