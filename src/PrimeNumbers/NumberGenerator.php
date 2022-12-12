<?php

namespace Oesteve\PrimeNumbers;

final class NumberGenerator
{
    /**
     * Return positive numbers generator from 1 with the length provided.
     */
    public static function generateNumbers(int $length): \Generator
    {
        self::validateLength($length);

        for ($i = 1; $i <= $length; ++$i) {
            yield $i;
        }
    }

    private static function validateLength(int $length): void
    {
        if ($length < 0) {
            throw new \InvalidArgumentException('Length must be positive');
        }
    }
}
