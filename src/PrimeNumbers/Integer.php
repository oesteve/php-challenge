<?php

namespace Oesteve\PrimeNumbers;

final class Integer
{
    /**
     * Return all numbers it is a multiple of the given number.
     *
     * @return array<int,int>
     */
    public static function divisors(int $value): array
    {
        $divisors = [];

        for ($i = 2; $i <= sqrt($value); ++$i) {
            if (0 === $value % $i) {
                $divisors[] = $i;
            }
        }

        for ($i = \count($divisors) - 1; $i >= 0; --$i) {
            $divider = $divisors[$i];
            $division = $value / $divider;

            if ($division === $divider) {
                continue;
            }

            $divisors[] = $division;
        }

        return $divisors;
    }
}
