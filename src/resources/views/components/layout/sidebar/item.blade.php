@if ($grouped)
    <li x-data="{ show : false }">
        <button x-on:click="show = !show"
                type="button"
                class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm/6 font-semibold text-gray-700 hover:bg-gray-100 transition-all">
            @if ($icon instanceof \Illuminate\View\ComponentSlot)
                {{ $icon }}
            @elseif ($icon)
                <x-dynamic-component :component="TallStackUi::prefix('icon')"
                                     :icon="TallStackUi::icon($icon)"
                                     internal
                                     class="w-6 h-6 shrink-0 text-gray-400" />
            @endif
            {{ $label }}
            @if ($collapseIcon instanceof \Illuminate\View\ComponentSlot)
                {{ $collapseIcon }}
            @else
                <x-tallstack-ui::icon.generic.chevron-down class="ml-auto w-4 h-4 shrink-0 text-gray-400 transition-all"
                                                           x-bind:class="{
                                                                'rotate-180 text-gray-500': show,
                                                                'text-gray-400': !show
                                                           }" />
            @endif
        </button>
        <ul x-show="show" class="mt-1 px-2">
            {{ $slot }}
        </ul>
    </li>
@else
    <li>
        <a @if ($route) href="{{ $route }}" @endif class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-700 hover:bg-gray-100 transition-all">
            @if ($icon instanceof \Illuminate\View\ComponentSlot)
                {{ $icon }}
            @elseif ($icon)
                <x-dynamic-component :component="TallStackUi::prefix('icon')"
                                     :icon="TallStackUi::icon($icon)"
                                     internal
                                     class="w-6 h-6 shrink-0 text-gray-400" />
            @endif
            {{ $label ?? $slot }}
        </a>
    </li>
@endif
