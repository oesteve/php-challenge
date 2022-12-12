<?php

namespace Oesteve\Test\Ascii;

use Oesteve\Ascii\CharGenerator;
use PHPUnit\Framework\TestCase;

final class CharGeneratorTest extends TestCase
{
    public function testInvalidChar(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The from and to must contain only one character');
        CharGenerator::range('abc', 'edr');
    }

    public function testGetAsciiRange(): void
    {
        $range = CharGenerator::range('a', 'd');

        $this->assertEquals(['a', 'b', 'c', 'd'], $range);
    }

    public function testGetAsciiRangeRestart(): void
    {
        $range = CharGenerator::range('b', 'a');

        $this->assertCount(128, $range);
    }

    public function testCompareWithRange(): void
    {
        $a = CharGenerator::range(',', '|');
        $b = range(',', '|');

        $this->assertEquals($a, $b);
    }
}
