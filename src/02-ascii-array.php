<?php

require_once __DIR__.'/../vendor/autoload.php';

use Oesteve\Ascii\Arrays;
use Oesteve\Ascii\CharGenerator;

/**
 * A random array containing all the ASCII characters from comma (",") to pipe ("|").
 */
$chars = CharGenerator::range(',', '|');
$chars = Arrays::randomise($chars);

/*
 * Randomly remove and discard an arbitrary element from this newly generated array
 */
[$remainingChars, $discardedCharacter] = Arrays::removeElementRandom($chars);

/**
 * Determine the missing character.
 */
$missingCharacter = Arrays::findMissing($chars, $remainingChars);

echo "The removed element was: {$discardedCharacter}".PHP_EOL;
echo "The missing character is: {$missingCharacter}".PHP_EOL;
