<?php

namespace Oesteve\PrimeNumbers;

final class Printer
{
    /**
     * @param array<int,mixed> $content a line generator with the content to print
     * @param array<callable>  $filters an optional collection of filters used to manipulate the content of every line
     * @param resource|null    $out     Optional parameter that provides where the output will be written. If it is not provided stdout will be used.
     */
    public static function writeLines(iterable $content, array $filters = [], $out = null): void
    {
        if (null === $out) {
            $stdout = fopen('php://stdout', 'w');

            if (false === $stdout) {
                throw new \RuntimeException('Unexpected error in the output stream');
            }

            $stream = $stdout;
        } else {
            $stream = $out;
        }

        foreach ($content as $number) {
            $string = $number;
            foreach ($filters as $filter) {
                $string = $filter($string);
            }

            fwrite($stream, $string.\PHP_EOL);
        }

        if (!$out) {
            fclose($stream);
        }
    }
}
