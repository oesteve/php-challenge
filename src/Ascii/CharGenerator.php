<?php

namespace Oesteve\Ascii;

final class CharGenerator
{
    /**
     * Return positive numbers generator from 1 with the length provided.
     *
     * @return array<string>
     */
    public static function range(string $from, string $to): array
    {
        self::validateChar($from);
        self::validateChar($to);

        $range = [];
        $i = \ord($from);
        $lastChar = \ord($to);
        do {
            $range[] = \chr($i);

            if (127 === $i) {
                $i = -1;
            }
        } while ($i++ !== $lastChar);

        return $range;
    }

    private static function validateChar(string $string): void
    {
        if (1 !== \strlen($string)) {
            throw new \InvalidArgumentException('The from and to must contain only one character');
        }
    }
}
