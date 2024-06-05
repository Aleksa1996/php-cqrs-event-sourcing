<?php

namespace App\Common\Application\Bus\Command;

interface CommandBus
{
    public function handle(object $command, array $stamps = []): CommandResult;
}
