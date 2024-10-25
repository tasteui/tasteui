@php
    $personalize = $classes();
@endphp

<div x-data="{ show: false }" @class($personalize["position.{$position}"])
    @if ($hover)
        x-on:mouseover="show = true"
        x-on:mouseleave="show = false"
    @endif
    >
    <button type="button" x-ref="button" @if (!$hover) x-on:click="show = !show" @endif dusk="tallstackui_dial_toggle" 
        @class([
            $colors['background'],
            $personalize['button'],
            'rounded-full' => !$square,
            'rounded-lg' => $square,
        ])>
        @if ($icon)
            <x-dynamic-component :component="TallStackUi::component('icon')"
                                 :icon="TallStackUi::icon($icon)"
                                 @class($personalize['icon']) />
        @else
            <x-dynamic-component :component="TallStackUi::component('icon')"
                                 :icon="TallStackUi::icon('plus')"
                                 x-bind:class="{ 'group-hover:rotate-45' : show }"
                                 @class($personalize['icon']) />
        @endif
        <span class="sr-only">Open actions menu</span>
    </button>
    <div @class([$personalize['items'], 'flex-col ' => !$horizontal])
         x-anchor{{ $horizontal ? '.left' : '' }}.offset.10="$refs.button"
         x-transition:enter="transition duration-100 ease-out"
         x-transition:enter-start="opacity-0 @if ($horizontal) translate-x-2 @else translate-y-2 @endif"
         x-transition:enter-end="opacity-100 @if ($horizontal) -translate-x-0 @else -translate-y-0 @endif"
         x-transition:leave="transition duration-100 ease-in"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-show="show">
        {{ $slot }}
    </div>
</div>