@php
    $personalize = $classes();
@endphp

@if ($slot->isNotEmpty())
    <li x-data="{ show : @js($opened ?? false) }">
        <button x-on:click="show = !show"
                type="button"
                class="{{ $personalize['group.button'] }}">
            @if ($icon instanceof \Illuminate\View\ComponentSlot)
                {{ $icon }}
            @elseif ($icon)
                <x-dynamic-component :component="TallStackUi::prefix('icon')"
                                     :icon="TallStackUi::icon($icon)"
                                     internal
                                     class="{{ $personalize['group.icon.base'] }}" />
            @endif
            {{ $text }}
            @if ($collapseIcon instanceof \Illuminate\View\ComponentSlot)
                {{ $collapseIcon }}
            @else
                <x-dynamic-component :component="TallStackUi::prefix('icon')"
                                     :icon="TallStackUi::icon('chevron-down')"
                                     internal
                                     class="{{ $personalize['group.icon.collapse.base'] }}"
                                     x-bind:class="{ '{{ $personalize['group.icon.collapse.rotate'] }}': show }" />
            @endif
        </button>
        <ul x-show="show" class="{{ $personalize['group.group'] }}">
            {{ $slot }}
        </ul>
    </li>
@else
    <li class="{{ $personalize['item.wrapper'] }}">
        <a @if ($route) href="{{ $route }}" @endif
            @class([
                $personalize['item.state.base'],
                $personalize['item.state.normal'] => ! $current,
                $personalize['item.state.current'] => $current,
            ]) @if ($navigate) wire:navigate @elseif ($navigateHover) wire:navigate.hover @endif>
            @if ($icon instanceof \Illuminate\View\ComponentSlot)
                {{ $icon }}
            @elseif ($icon)
                <x-dynamic-component :component="TallStackUi::prefix('icon')"
                                     :icon="TallStackUi::icon($icon)"
                                     internal
                                     class="{{ $personalize['item.icon'] }}" />
            @endif
            {{ $text }}
        </a>
    </li>
@endif
