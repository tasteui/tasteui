<div @if ($sidebar->isNotEmpty()) x-data="{ tallStackUiMenuMobile : false }" @endif>
    @if ($top)
        {{ $top }}
    @endif
    @if ($sidebar->isNotEmpty() && $sidebar->attributes->has('wrapped'))
        <x-dynamic-component :component="TallStackUi::prefix('layout.sidebar')" desktop-only>
            @if ($brand)
                <x-slot:brand>
                    {{ $brand }}
                </x-slot:brand>
            @endif
            {{ $sidebar }}
        </x-dynamic-component>
    @elseif ($sidebar->isNotEmpty())
        {{ $sidebar }}
    @endif
    <div class="min-h-full">
        <div class="md:pl-72">
            @if ($header)
                {{ $header }}
            @endif
            <main class="max-w-full mx-auto px-6 py-10">
                <div class="px-4">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    @if ($footer)
        {{ $footer }}
    @endif
</div>
