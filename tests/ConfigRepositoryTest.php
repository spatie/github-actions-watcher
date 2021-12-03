<?php

use App\Support\ConfigRepository;

it('can store and forget a token', function () {
    $config = new ConfigRepository();

    $config->setAccessToken('abc123');
    expect($config->accessToken)->toBe('abc123');

    $config->setGitHubUsername('johndoe');
    expect($config->gitHubUsername)->toBe('johndoe');

    $config->flush();
    expect($config->accessToken)->toBeNull();
    expect($config->gitHubUsername)->toBeNull();
});
