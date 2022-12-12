<?php

require_once __DIR__.'/../vendor/autoload.php';

use Oesteve\PrimeNumbers\Integer;
use Oesteve\PrimeNumbers\NumberGenerator;
use Oesteve\PrimeNumbers\Printer;

/**
 * This filter put beside each number, the numbers it is a multiple of (inside brackets and comma-separated). If only
 * multiple of itself then print "[PRIME]".
 */
$divisorsFilter = static function (int $number): string {
    // 1 can only be divided by one number, 1 itself
    if (1 === $number) {
        return (string) $number;
    }

    $divisors = Integer::divisors($number);

    $trailer = $divisors ? implode(',', $divisors) : 'PRIME';

    return sprintf('%d [%s]', $number, $trailer);
};

/*
 * Write all integer values from 1 to 100 and apply the previous filter
 */
Printer::writeLines(
    NumberGenerator::generateNumbers(100),
    [$divisorsFilter]
);
