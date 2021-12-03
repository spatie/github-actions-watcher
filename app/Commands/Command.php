<?php

namespace App\Commands;

use App\Support\ConfigRepository;
use App\Support\GitHub\GitHub;
use LaravelZero\Framework\Commands\Command as LaravelZeroCommand;
use function Termwind\render;

abstract class Command extends LaravelZeroCommand
{
    public function __construct(
        public ConfigRepository $config,
        public GitHub $gitHub,
    )
    {
        parent::__construct();
    }

    public function clearScreen(): self
    {
        $this->output->write(sprintf("\033\143"));

        return $this;
    }

    public function renderError(string $message): self
    {
        render("<p class='m-1 bg-red-800 text-white'>{$message}</p>");

        return $this;
    }

    public function message(string $message): self
    {
        render("<p class='m-1 bg-green-800 text-white'>{$message}</p>");

        return $this;
    }
}
