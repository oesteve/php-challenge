<?php

require_once __DIR__.'/../vendor/autoload.php';

use Oesteve\TVSeries\Application\UseCase\GetNextEpisode;
use Oesteve\TVSeries\Infrastructure\Config\App;

$app = new App();

// Tells when the next TV Series will air
$nextEpisode = $app->query(new GetNextEpisode());
echo "Watch the episode of \"{$nextEpisode->title}\" the next {$nextEpisode->day} at {$nextEpisode->hour}.".\PHP_EOL;

// Select a specific date-time
$nextEpisode = $app->query(new GetNextEpisode('2022-12-06 19:40'));
echo "At 2022-12-06 19:40, the next episode will be \"{$nextEpisode->title}\" in {$nextEpisode->day} at {$nextEpisode->hour}.".\PHP_EOL;

// Select a specific show title
$nextEpisode = $app->query(new GetNextEpisode(title: 'Stranger'));
echo "The next episode of \"{$nextEpisode->title}\" will be the next {$nextEpisode->day} at {$nextEpisode->hour}.".\PHP_EOL;
