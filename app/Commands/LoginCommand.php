<?php

namespace App\Commands;

use App\Support\ConfigRepository;

use function Termwind\render;

class LoginCommand extends Command
{
    protected $signature = 'login {--token=}';

    protected $description = 'Login to GitHub';

    public function handle()
    {
        if ($username = $this->config->gitHubUsername) {
            $this->error("You are already logged in as {$username}. Run `actions-watcher logout` to logout first.");
        }

        $verificationData =  $this->gitHub->startUserVerification();

        $this->clearScreen();

        $view = view('login', [
            'verificationUrl' => $verificationData['verification_uri'],
            'userCode' => $verificationData['user_code'],
        ]);

        render($view);

        do {
            $accessToken = $this->checkResponse($verificationData['device_code']);
        } while(! $accessToken);

        $this->info('got token' . $accessToken);
        $user = $this->gitHub->getAuthorizedUser($accessToken);

        $this->config->setAccessToken($accessToken, $user['login']);


        $this->config->setAccessToken($accessToken);
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
