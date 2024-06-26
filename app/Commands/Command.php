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
    ) {
        parent::__construct();
    }

    public function clearScreen(): self
    {
        $this->output->write(sprintf("\033\143"));

        return $this;
    }

    public function showHeader(): self
    {
        $view = view('header', [
            'gitHubUsername' => $this->config->gitHubUsername,
        ]);

        render($view);

        return $this;
    }

    public function showSuccess(string $message): self
    {
        return $this->showMessage($message, 'bg-green-800');
    }

    public function showError(string $message): self
    {
        return $this->showMessage($message, 'bg-red-800');
    }

    public function showMessage(string $message, string $backgroundColor = 'bg-green-800'): self
    {
        $view = view('message', [
            'message' => $message,
            'backgroundColor' => $backgroundColor,
        ]);

        render((string)$view);

        return $this;
    }
}
