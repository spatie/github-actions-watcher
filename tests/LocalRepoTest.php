<?php

use App\Support\LocalGitRepo;

beforeEach(function() {
    $this->localGitRepo = new LocalGitRepo(__DIR__ . '/..');
});

it('can get the local repo', function() {
   expect($this->localGitRepo->getVendorAndRepo())->toBe('spatie/github-actions-watcher');
});

it('can get the current branch', function() {
    expect($this->localGitRepo->getCurrentBranch())->toBe('main');

});
