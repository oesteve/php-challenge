<?php

namespace Oesteve\TVSeries\Domain\Model\TVSeries;

final class TVSeries
{
    private ?int $id = null;

    private string $title;

    private string $channel;

    private TVSeriesInterval $interval;

    public function __construct(string $title, string $channel, TVSeriesInterval $interval)
    {
        $this->title = $title;
        $this->channel = $channel;
        $this->interval = $interval;
    }

    /**
     * @param array<string,string> $data
     */
    public static function fromData(array $data): self
    {
        return new self(
            title: $data['title'],
            channel: $data['channel'],
            interval: TVSeriesInterval::fromData($data),
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getInterval(): TVSeriesInterval
    {
        return $this->interval;
    }
}
