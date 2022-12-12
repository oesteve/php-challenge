<?php

namespace Oesteve\TVSeries\Domain\Model\TVSeries;

interface TVSeriesRepository
{
    public function findEpisode(\DateTime $dateTime, ?string $title): ?TVSeries;

    public function save(TVSeries $episode): void;
}
