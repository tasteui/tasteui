@php
    $personalize = $classes();
@endphp

<div @if ($sideBar->isNotEmpty())
         x-data="{ tallStackUiMenuMobile : false }"
         x-on:tallstackui-menu-mobile.window="tallStackUiMenuMobile = $event.detail.status"
    @endif>
    @if ($top)
        {{ $top }}
    @endif
    @if ($sideBar->isNotEmpty() && $sideBar->attributes->has('wrapped'))
        <x-dynamic-component :component="TallStackUi::prefix('layout.side-bar')">
            @if ($brand)
                <x-slot:brand>
                    {{ $brand }}
                </x-slot:brand>
            @endif
            {{ $sideBar }}
        </x-dynamic-component>
    @elseif ($sideBar->isNotEmpty())
        {{ $sideBar }}
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
