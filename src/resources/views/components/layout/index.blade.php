<div>
    @if ($left)
        {{ $left }}
    @endif
    <div class="min-h-full">
        <div class="lg:pl-72">
            @if ($header)
                {{ $header }}
            @endif
            <main class="max-w-full mx-auto sm:px-6 lg:px-8 py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    @if ($footer)
        {{ $footer }}
    @endif
</div>
