<div class="mx-4 mt-1">
    <div>
        Workflow runs for {{ $vendorAndRepo }} on the {{ $branch }} branch
    </div>

    @if ($runs->isEmpty())
        <div>
            No workflow runs found for this repo...
        </div>
    @endif

    <ul>
        @foreach($runs as $run)
            <li><a href="{{ $run->html_url }}">{{ $run->name }}</a>: ({{ $run->getListStatus()->humanReadableValue() }})</li>
        @endforeach
    </ul>

    @if ($runs->containsActiveRuns())
        <div class="mt-1">
            Running workflows detected. Refreshing automatically...
        </div>
    @endif
</div>
