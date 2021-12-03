<div class="mt-1 mx-4">
    <div class="w-full text-white text-center bg-blue-800"></div>
    <div class="w-full text-white bg-blue-800">
        <span class="p-2 text-left w-1/2">GitHub Actions Watcher by Spatie</span>
        <span class="p-2 text-right w-1/2">
            @if($gitHubUsername)
                Logged in as {{ $gitHubUsername }}
            @else
                Not logged in
            @endif
        </span>
    </div>
    <div class="w-full text-white text-center bg-blue-800"></div>
</div>
