<div class="m-1">
    <div>By authenticating with GitHub, you can see workflows of private repos and enjoy higher rate
        limits.
    </div>
    <div class="mt-1">You will need to type this code when connecting to GitHub: <span class="bg-blue-500 text-white">{{ $userCode }}</span></div>

        <div class="mt-1"><a href="{{ $verificationUrl }}">Connect to GitHub</a>.</div>
        <div class="mt-1">Copy this URL in your browser, if you can't click the link above: <a href="{{ $verificationUrl }}">{{ $verificationUrl }}</div>
        <div class="mt-1">Waiting for you to complete the authorization flow on GitHub...</div>
</div>
