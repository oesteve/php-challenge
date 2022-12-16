<?php

namespace Oesteve\ABTest;

final class Simulator
{
    private int $samples;

    /** @var array<string, int> */
    private array $results = [];

    public function __construct(int $samples)
    {
        $this->samples = $samples;
    }

    /**
     * @param callable():string $call
     */
    public function simulate(callable $call): void
    {
        for ($i = 0; $i < $this->samples; ++$i) {
            $optionName = $call();
            if (!isset($this->results[$optionName])) {
                $this->results[$optionName] = 1;
                continue;
            }

            ++$this->results[$optionName];
        }
    }

    public function print(): void
    {
        echo "In a simulation of {$this->samples} samples:".PHP_EOL;

        $one = 100 / $this->samples;
        $divider = '';

        foreach ($this->results as $optionNameKey => $count) {
            $percent = (int) ($one * $count);
            echo "  {$divider}'{$optionNameKey}' has been picked: {$count} times [{$percent}%]".PHP_EOL;
        }

        echo PHP_EOL;
    }
}
