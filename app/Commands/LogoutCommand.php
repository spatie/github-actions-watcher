<?php

namespace App\Commands;

use App\Support\ConfigRepository;

use function Termwind\render;

class LogoutCommand extends Command
{
    protected $signature = 'logout';

    protected $description = 'Logout form GitHub';

    public function handle()
    {
        if (! $username = $this->config->gitHubUsername) {
            $this
                ->showHeader()
                ->showError("Nobody was logged in.");

            return static::FAILURE;
        }

        $this->config->flush();

        $this
            ->showHeader()
            ->showSuccess("{$username} has been logged out.");

        return static::SUCCESS;
    }
}
