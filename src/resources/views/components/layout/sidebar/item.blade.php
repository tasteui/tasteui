@php
    $personalize = $classes();
@endphp

@if ($grouped)
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
            {{ $label }}
            @if ($collapseIcon instanceof \Illuminate\View\ComponentSlot)
                {{ $collapseIcon }}
            @else
                <x-tallstack-ui::icon.generic.chevron-down class="{{ $personalize['grouped.icon.collapse.base'] }}"
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
                $personalize['normal.state.deactivated'] => ! $activated,
                $personalize['normal.state.activated'] => $activated,
            ])>
            @if ($icon instanceof \Illuminate\View\ComponentSlot)
                {{ $icon }}
            @elseif ($icon)
                <x-dynamic-component :component="TallStackUi::prefix('icon')"
                                     :icon="TallStackUi::icon($icon)"
                                     internal
                                     @class([
                                        $personalize['normal.icon.base'],
                                        $personalize['normal.icon.deactivated'] => ! $activated,
                                        $personalize['normal.icon.activated'] => $activated,
                                    ]) />
            @endif
            {{ $label ?? $slot }}
        </a>
    </li>
@endif
