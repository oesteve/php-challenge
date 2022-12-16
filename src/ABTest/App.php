<?php

namespace Oesteve\ABTest;

use Exads\ABTestData;

final class App
{
    /** @var array<int> */
    private array $designs = [];
    private int $nextPosition = 0;
    private ABTestData $abTest;

    public function __construct(ABTestData $abTest)
    {
        $this->abTest = $abTest;

        foreach ($this->abTest->getAllDesigns() as $design) {
            $count = $design['splitPercent'];
            $value = $design['designId'];
            $values = array_fill(0, $count, $value);
            array_push($this->designs, ...$values);
        }

        if (100 !== count($this->designs)) {
            throw new \RuntimeException('Invalid splitPercent configuration');
        }

        shuffle($this->designs);
    }

    public function getDesign(): string
    {
        $position = $this->getPosition();
        $designId = $this->designs[$position];
        $design = $this->abTest->getDesign($designId);

        return $design['designName'];
    }

    private function getPosition(): int
    {
        $position = $this->nextPosition++;

        if (99 === $position) {
            $this->nextPosition = 0;
        }

        return $position;
    }
}
