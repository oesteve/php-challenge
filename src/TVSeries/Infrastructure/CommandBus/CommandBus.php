<?php

namespace Oesteve\TVSeries\Infrastructure\CommandBus;

interface CommandBus
{
    /**
     * @return object|null
     */
    public function query(object $command);

    public function dispatch(object $command): void;
}
