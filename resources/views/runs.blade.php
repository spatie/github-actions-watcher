<div class="m-1">
    <ul>
    @foreach($runs as $run)
        <li>{{ $run->name }}: {{ $run->status }}</li>
    @endforeach
    </ul>
</div>
