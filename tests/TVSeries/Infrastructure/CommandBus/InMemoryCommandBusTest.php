<?php

namespace Oesteve\Test\TVSeries\Infrastructure\CommandBus;

use Oesteve\TVSeries\Infrastructure\CommandBus\InMemoryCommandBus;
use PHPUnit\Framework\TestCase;

final class InMemoryCommandBusTest extends TestCase
{
    public function testRequestQuery(): void
    {
        $bus = new InMemoryCommandBus([
            MyCommand::class => fn () => new MyCommandHandler(),
        ]);

        /** @var MyCommandResponse $response */
        $response = $bus->query(new MyCommand('bar'));

        $this->assertEquals($response->bar, 'bar');
    }
}

final class MyCommand
{
    public string $payload;

    public function __construct(string $payload)
    {
        $this->payload = $payload;
    }
}

final class MyCommandHandler
{
    public function __invoke(MyCommand $command): MyCommandResponse
    {
        return new MyCommandResponse($command->payload);
    }
}

final class MyCommandResponse
{
    public string $bar;

    public function __construct(string $bar)
    {
        $this->bar = $bar;
    }
}
