<?php

use App\Support\ConfigRepository;

it('can store and forget a token', function() {
    $tokenValue = 'abc123';

    $config = new ConfigRepository();

    $config->setAccessToken($tokenValue);
    expect($config->token)->toBe($tokenValue);

    $config->forgetAccessToken();
    expect($config->accessToken)->toBeNull();
});
