<div class="mt-1 mx-4">
    <div class="w-full py-1 px-2 text-white bg-blue-800">
        <span class="text-left w-1/2">GitHub Actions Watcher by Spatie</span>
        <span class="text-right w-1/2">
            @if($gitHubUsername)
                Logged in as {{ $gitHubUsername }}
            @else
                Not logged in
            @endif
        </span>
    </div>
</div>
