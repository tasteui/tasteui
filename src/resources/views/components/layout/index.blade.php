<div>
    {{ $left }}
    <div class="min-h-full">
        <div class="lg:pl-72">
            {{ $header }}
            <main class="max-w-full mx-auto sm:px-6 lg:px-8 py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    {{ $footer }}
</div>
