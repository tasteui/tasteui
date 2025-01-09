@php
    $personalize = $classes();
@endphp

@if ($slot->isNotEmpty())
    <li x-data="{ show : @js($opened ?? false) }">
        <button x-on:click="show = !show"
                type="button"
                class="{{ $personalize['grouped.button'] }}">
            @if ($icon instanceof \Illuminate\View\ComponentSlot)
                {{ $icon }}
            @elseif ($icon)
                <x-dynamic-component :component="TallStackUi::prefix('icon')"
                                     :icon="TallStackUi::icon($icon)"
                                     internal
                                     class="{{ $personalize['grouped.icon.base'] }}" />
            @endif
            {{ $text }}
            @if ($collapseIcon instanceof \Illuminate\View\ComponentSlot)
                {{ $collapseIcon }}
            @else
                <x-dynamic-component :component="TallStackUi::prefix('icon')"
                                     :icon="TallStackUi::icon('chevron-down')"
                                     internal
                                     class="{{ $personalize['grouped.icon.collapse.base'] }}"
                                     x-bind:class="{ '{{ $personalize['grouped.icon.collapse.rotate'] }}': show }" />
            @endif
        </button>
        <ul x-show="show" class="{{ $personalize['grouped.group'] }}">
            {{ $slot }}
        </ul>
    </li>
@else
    <li>
        <a @if ($route) href="{{ $route }}" @endif
            @class([
                $personalize['normal.state.base'],
                $personalize['normal.state.deactivated'] => ! $current,
                $personalize['normal.state.activated'] => $current,
            ]) @if ($navigate) wire:navigate @elseif ($navigateHover) wire:navigate.hover @endif>
            @if ($icon instanceof \Illuminate\View\ComponentSlot)
                {{ $icon }}
            @elseif ($icon)
                <x-dynamic-component :component="TallStackUi::prefix('icon')"
                                     :icon="TallStackUi::icon($icon)"
                                     internal
                                     @class([
                                        $personalize['normal.icon.base'],
                                        $personalize['normal.icon.deactivated'] => ! $current,
                                        $personalize['normal.icon.activated'] => $current,
                                    ]) />
            @endif
            {{ $text }}
        </a>
    </li>
@endif
