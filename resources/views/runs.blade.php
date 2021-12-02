<div class="m-1">
    <ul>
    @foreach($runs as $run)
        <li><a href="{{ $run->html_url }}">{{ $run->name }}</a>: {{ $run->status }}</li>
    @endforeach
    </ul>
</div>
