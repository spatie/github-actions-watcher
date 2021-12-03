<?php

namespace App\Commands;

use function Termwind\render;

class LoginCommand extends Command
{
    protected $signature = 'login {--token=}';

    protected $description = 'Login to GitHub';

    public function handle()
    {
        if ($username = $this->config->gitHubUsername) {
            $this
                ->showHeader()
                ->showError("You are already logged in as {$username}. Run `actions-watcher logout` to logout first.");

            return static::FAILURE;
        }

        $verificationData =  $this->gitHub->startUserVerification();

        $this
            ->clearScreen()
            ->showHeader();

        $view = view('login', [
            'verificationUrl' => $verificationData['verification_uri'],
            'userCode' => $verificationData['user_code'],
        ]);

        render($view);

        do {
            $accessToken = $this->checkResponse($verificationData['device_code']);
        } while(! $accessToken);

        $gitHubUser = $this->gitHub->getAuthorizedUser($accessToken);

        $this->config
            ->setAccessToken($accessToken)
            ->setGitHubUsername($gitHubUser['login']);

        $this
            ->clearScreen()
            ->showHeader()
            ->showSuccess("You have been successfully logged in as {$gitHubUser['login']}");

        return static::SUCCESS;
    }

    protected function checkResponse(string $deviceCode): ?string
    {
        sleep(5);

        return $this->gitHub->getAccessToken($deviceCode);
    }

    protected function isValidToken(string $token): bool
    {

    }
}
