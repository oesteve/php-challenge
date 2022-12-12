<?php

namespace Oesteve\TVSeries\Application\UseCase;

use Oesteve\TVSeries\Domain\Model\TVSeries\TVSeries;

final class EpisodeDto
{
    /**
     * @readonly
     */
    public string $title;
    /**
     * @readonly
     */
    public string $channel;
    /**
     * @readonly
     */
    public string $day;
    /**
     * @readonly
     */
    public string $hour;

    public function __construct(string $title, string $channel, string $day, string $time)
    {
        $this->title = $title;
        $this->channel = $channel;
        $this->day = $day;
        $this->hour = $time;
    }

    public static function fromEntity(TVSeries $res): self
    {
        $day = match ($res->getInterval()->getWeekDay()) {
            0 => 'Monday',
            1 => 'Tuesday',
            2 => 'Wednesday',
            3 => 'Thursday',
            4 => 'Friday',
            5 => 'Saturday',
            6 => 'Sunday',
            default => throw new \InvalidArgumentException('Unexpected day value')
        };

        return new self(
            title: $res->getTitle(),
            channel: $res->getChannel(),
            day: $day,
            time: $res->getInterval()->getShowTime()
        );
    }
}
