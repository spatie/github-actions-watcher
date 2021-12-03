<?php

namespace App\Support\GitHub;

use App\Exceptions\FailedGitHubResponse;
use App\Exceptions\RateLimitExceeded;
use App\Support\ConfigRepository;
use App\Support\GitHub\Entities\WorkflowRun;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

use Illuminate\Http\Client\PendingRequest;

class GitHub
{
    public function __construct(public PendingRequest $gitHub, ConfigRepository $config)
    {
        $this->gitHub->acceptJson();

        if ($accessToken = $config?->accessToken) {
            //$this->addAuthenticationHeader($accessToken);
        }
    }

    /**
     * @param string $vendorAndRepo
     *
     * @return Collection<WorkflowRun>
     */
    public function getWorkflowRuns(string $vendorAndRepo, string $branch): Collection
    {
        [$vendor, $repo] = explode('/', $vendorAndRepo);

        $response = $this->gitHub
            ->get("/api.github.com/repos/{$vendor}/{$repo}/actions/runs", ['branch' => $branch]);

        $this->ensureSuccessfulRequest($response);

        collect($response->json('workflow_runs'))
            ->map(fn(array $workflowRunProperties) => new WorkflowRun($workflowRunProperties))
            ->orderBy(fn(WorkflowRun $run) => $run->name);
    }

    /**
     * @param string $vendorAndRepo
     *
     * @return Collection<WorkflowRun>
     */
    public function getLatestWorkflowRuns(string $vendorAndRepo, string $branch): Collection
    {
        return $this
            ->getWorkflowRuns($vendorAndRepo, $branch)
            ->unique(fn(WorkflowRun $workflowRun) => $workflowRun->name);
    }

    protected function ensureSuccessfulRequest(Response $response): void
    {
        if ($response->successful()) {
            return;
        }

        if ($response->getReasonPhrase() === 'rate limit exceeded') {
            throw RateLimitExceeded::make($response);
        }

        throw FailedGitHubResponse::make($response);
    }

    /** @return array{verification_uri: string, device_code: string, user_code: string} */
    public function startUserVerification(): array
    {
        return $this->gitHub
            ->post('https://github.com/login/device/code', [
                'client_id' => config('services.github.client_id'),
                'scope' => 'repo',
            ])->json();
    }

    public function getAccessToken(string $deviceCode): ?string
    {
        $response =  $this
            ->gitHub
            ->post('https://github.com/login/oauth/access_token', [
                'client_id' => config('services.github.client_id'),
                'device_code' => $deviceCode,
                'grant_type' => 'urn:ietf:params:oauth:grant-type:device_code',
            ]);

            return $response->json('access_token');
    }

    /**
     * @param string|null $accessToken
     *
     * @return array{login: string}
     */
    public function getAuthorizedUser(string $accessToken = null): array
    {
        $this->addAuthenticationHeader($accessToken);

        return $this->gitHub->withToken($accessToken)->get('https://api.github.com/user')->json();
    }

    protected function addAuthenticationHeader(string $accessToken): self
    {
        $this->gitHub->withHeaders(['Authorization' => "token {$accessToken}"]);

        return $this;
    }
}
