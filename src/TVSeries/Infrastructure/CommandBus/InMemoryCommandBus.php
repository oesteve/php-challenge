<?php

namespace Oesteve\TVSeries\Infrastructure\CommandBus;

final class InMemoryCommandBus implements CommandBus
{
    /**
     * @var array<string, callable>
     */
    private array $definitions;

    /**
     * @param array<string, callable> $definitions
     */
    public function __construct(array $definitions)
    {
        $this->definitions = $definitions;
    }

    /**
     * @return object|null
     */
    public function query(object $command)
    {
        $class = \get_class($command);

        if (\array_key_exists($class, $this->definitions)) {
            return $this->definitions[$class]()($command);
        }

        throw new \RuntimeException("Definition for class {$class} not found");
    }

    public function dispatch(object $command): void
    {
        // TODO: Implement dispatch() method.
    }
}
