<div>
    <span class="w-11 mr-1">
        <span class="{{ $run->getListStatus()->color() }} font-bold uppercase">{{ $run->getListStatus()->humanReadableValue() }} </span>
        <span class="ml-1">........</span>
    </span>
    <a class="font-bold" href="{{ $run->html_url }}">{{ $run->name }}</a>
</div>
