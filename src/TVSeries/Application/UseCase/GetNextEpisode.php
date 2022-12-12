<?php

namespace Oesteve\TVSeries\Application\UseCase;

final class GetNextEpisode
{
    public function __construct(
        /**
         * @readonly
         */
        public ?string $dateTime = null,
        /**
         * @readonly
         */
        public ?string $title = null
    ) {
    }
}
