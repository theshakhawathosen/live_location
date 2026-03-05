    @session('success')
        <div id="toast">
            <i class="fa-solid fa-circle-check" style="color: var(--success); font-size: 16px"></i>
            {{ Session::get('success') }}
        </div>
    @endsession

    @session('error')
        <div id="toast">
            <i class="fa-solid fa-times" style="color: var(--red); font-size: 16px"></i>
            {{ Session::get('error') }}
        </div>
    @endsession
