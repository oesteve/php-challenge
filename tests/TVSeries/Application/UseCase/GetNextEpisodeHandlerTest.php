<?php

namespace Oesteve\Test\TVSeries\Application\UseCase;

use Oesteve\TVSeries\Application\UseCase\EpisodeDto;
use Oesteve\TVSeries\Application\UseCase\GetNextEpisode;
use Oesteve\TVSeries\Infrastructure\Config\App;
use PHPUnit\Framework\TestCase;

final class GetNextEpisodeHandlerTest extends TestCase
{
    public function testQueryWithoutParameters(): void
    {
        $app = new App();

        $command = new GetNextEpisode();
        $episode = $app->query($command);

        $this->assertNotNull($episode);
    }

    public function testFindByDate(): void
    {
        $app = new App();

        $command = new GetNextEpisode(
            dateTime: '2022-12-06 18:59:59' // Tuesday
        );

        /** @var EpisodeDto $episode */
        $episode = $app->query($command);

        $this->assertEquals('Breaking Bad', $episode->title);
        $this->assertEquals('Tuesday', $episode->day);
    }

    public function testGetNextEpisodeAfterStart(): void
    {
        $app = new App();

        $command = new GetNextEpisode(
            dateTime: '2022-12-06 19:00:01' // Tuesday
        );

        /** @var EpisodeDto $episode */
        $episode = $app->query($command);

        $this->assertEquals('The Crow', $episode->title);
    }

    public function testFilterByName(): void
    {
        $app = new App();

        $command = new GetNextEpisode(
            title: 'Stranger'
        );

        /** @var EpisodeDto $episode */
        $episode = $app->query($command);

        $this->assertEquals('Stranger Things', $episode->title);
    }

    public function testFilterByNameWithoutResults(): void
    {
        $app = new App();

        $command = new GetNextEpisode(
            title: 'Dark'
        );

        /** @var EpisodeDto $episode */
        $episode = $app->query($command);

        $this->assertNull($episode);
    }
}
