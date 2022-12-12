<?php

namespace Oesteve\Test\PrimeNumbers;

use Oesteve\PrimeNumbers\Printer;
use PHPUnit\Framework\TestCase;

final class PrinterTest extends TestCase
{
    public function testPrintNumber(): void
    {
        $out = $this->getOutputStream();

        Printer::writeLines([33], [], $out);

        $this->assetStreamEquals('33'.PHP_EOL, $out);
    }

    public function testPrintMultipleNumbers(): void
    {
        $out = $this->getOutputStream();

        Printer::writeLines([0, 1], [], $out);

        $this->assetStreamEquals('0'.PHP_EOL.'1'.PHP_EOL, $out);
    }

    public function testApplyFilters(): void
    {
        $out = $this->getOutputStream();

        $filters = [
            fn (string $string) => '['.$string,
            fn (string $string) => $string.']',
        ];
        Printer::writeLines([0, 1], $filters, $out);

        $this->assetStreamEquals('[0]'.PHP_EOL.'[1]'.PHP_EOL, $out);
    }

    /**
     * @param resource|false $out
     */
    private function assetStreamEquals(string $expected, $out): void
    {
        if (!$out) {
            throw new \RuntimeException('Invalid output stream');
        }

        rewind($out);
        $streamContents = stream_get_contents($out);
        fclose($out);

        $this->assertEquals($expected, $streamContents);
    }

    /**
     * @return resource
     */
    private function getOutputStream()
    {
        $output = fopen('php://memory', 'wb');

        if (!$output) {
            throw new \RuntimeException('Unexpected error generating output stream');
        }

        return $output;
    }
}
