@php
    $personalize = $classes();
@endphp

<div @if ($sidebar->isNotEmpty())
         x-data="{ tallStackUiMenuMobile : false }"
         x-on:tallstackui-menu-mobile.window="tallStackUiMenuMobile = $event.detail.status"
    @endif>
    @if ($top)
        {{ $top }}
    @endif
    @if ($sidebar->isNotEmpty() && $sidebar->attributes->has('wrapped'))
        <x-dynamic-component :component="TallStackUi::prefix('layout.sidebar')">
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
    <div class="{{ $personalize['wrapper.first'] }}">
        <div class="{{ $personalize['wrapper.second'] }}">
            @if ($header)
                {{ $header }}
            @endif
            <main class="{{ $personalize['main'] }}">
                {{ $slot }}
            </main>
        </div>
    </div>
    @if ($footer)
        {{ $footer }}
    @endif
</div>
