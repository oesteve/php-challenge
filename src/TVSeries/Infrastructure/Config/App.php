<?php

namespace Oesteve\TVSeries\Infrastructure\Config;

use Dotenv\Dotenv;
use Oesteve\TVSeries\Application\UseCase\GetNextEpisode;
use Oesteve\TVSeries\Application\UseCase\GetNextEpisodeHandler;
use Oesteve\TVSeries\Infrastructure\CommandBus\CommandBus;
use Oesteve\TVSeries\Infrastructure\CommandBus\InMemoryCommandBus;
use Oesteve\TVSeries\Infrastructure\MySQL\MySQLTVSeriesRepository;

final class App
{
    private CommandBus $commandBus;

    public function __construct()
    {
        $this->loadDotEnv();

        $dbHost = $_ENV['DB_HOST'];
        $dbUsername = $_ENV['DB_USERNAME'];
        $dbPassword = $_ENV['DB_PASSWORD'];
        $dbName = $_ENV['DB_NAME'];

        $repository = new MySQLTVSeriesRepository(
            $dbHost,
            $dbUsername,
            $dbPassword,
            $dbName,
        );

        $this->commandBus = new InMemoryCommandBus([
            GetNextEpisode::class => fn () => new GetNextEpisodeHandler($repository),
        ]);
    }

    public function query(object $command): mixed
    {
        return $this->commandBus->query($command);
    }

    private function loadDotEnv(): void
    {
        $dotenv = Dotenv::createImmutable(\dirname(__DIR__, 4));
        $dotenv->load();
    }
}
