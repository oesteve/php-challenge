<?php

namespace Oesteve\TVSeries\Application\UseCase;

use Oesteve\TVSeries\Domain\Model\TVSeries\TVSeriesRepository;

final class GetNextEpisodeHandler
{
    public function __construct(
        private TVSeriesRepository $TVSeriesRepository
    ) {
    }

    public function __invoke(GetNextEpisode $episode): ?EpisodeDto
    {
        $dateTime = new \DateTime($episode->dateTime ?? 'now');

        $res = $this->TVSeriesRepository->findEpisode($dateTime, $episode->title);

        if (!$res) {
            return null;
        }

        return EpisodeDto::fromEntity($res);
    }
}
