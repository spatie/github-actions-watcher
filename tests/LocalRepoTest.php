<?php

use App\Support\LocalGitRepo;

it('can get the local repo', function() {
   $localGitRepo = new LocalGitRepo(__DIR__ . '/..');

   expect($localGitRepo->getVendorAndRepo())->toBe('spatie/github-actions-watcher');
});
