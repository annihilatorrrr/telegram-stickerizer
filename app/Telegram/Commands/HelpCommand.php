<?php

namespace App\Telegram\Commands;

class HelpCommand extends StartCommand
{
    protected string $command = 'help';

    protected ?string $description = 'Help message';
}
