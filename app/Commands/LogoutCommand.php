<?php

namespace App\Commands;

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
