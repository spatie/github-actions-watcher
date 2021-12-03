<div class="mx-4 mt-1">
    <div>
        Workflow runs for {{ $vendorAndRepo }} on the {{ $branch }} branch.
    </div>

    @if ($runs->isEmpty())
        <div>
            No workflow runs found for this repo...
        </div>
    @endif


    <div class="mt-1">
        @foreach($runs as $run)
            @include('run')
        @endforeach
    </div>

    @if ($runs->containsActiveRuns())
        <div class="mt-1">
            Running workflows detected. Refreshing automatically...
        </div>
    @endif
</div>
