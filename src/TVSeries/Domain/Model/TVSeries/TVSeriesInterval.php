<?php

namespace Oesteve\TVSeries\Domain\Model\TVSeries;

final class TVSeriesInterval
{
    private int $weekDay;

    private string $showTime;

    public function __construct(int $weekDay, string $showTime)
    {
        $this->weekDay = $weekDay;
        $this->showTime = $showTime;
    }

    public function getWeekDay(): int
    {
        return $this->weekDay;
    }

    public function getShowTime(): string
    {
        return $this->showTime;
    }

    /**
     * @param array<string,mixed> $data
     */
    public static function fromData(array $data): self
    {
        return new self(
            $data['week_day'],
            $data['show_time'],
        );
    }
}
