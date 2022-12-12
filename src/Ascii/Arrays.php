<?php

namespace Oesteve\Ascii;

final class Arrays
{
    /**
     * @param array<int,mixed> $array
     *
     * @return array<int,mixed>
     *
     * @throws \Exception<int,mixed>
     */
    public static function randomise(array $array): array
    {
        $res = [];
        $count = \count($array);

        if (0 === $count) {
            return $array;
        }

        $nLastElement = $count - 1;
        for ($i = $nLastElement; $i >= 0; --$i) {
            $pos = random_int(0, $nLastElement);
            [$extracted] = array_splice($array, $pos, 1);
            $res[] = $extracted;
            --$nLastElement;
        }

        return $res;
    }

    /**
     * @param array<int,mixed> $array
     *
     * @return array<int,mixed>
     *
     * @throws \Exception
     */
    public static function removeElementRandom(array $array): array
    {
        $count = \count($array);

        if (0 === $count) {
            return $array;
        }

        $randomElementKey = random_int(0, $count - 1);
        [$discardCharacter] = array_splice($array, $randomElementKey, 1);

        return [$array, $discardCharacter];
    }

    /**
     * @param array<int,mixed> $a
     * @param array<int,mixed> $b
     */
    public static function findMissing(array $a, array $b): mixed
    {
        $diff = array_diff($a, $b);

        if (0 === \count($diff)) {
            throw new \InvalidArgumentException('Arrays are similar');
        }

        return array_values($diff)[0];
    }
}
