{{--<li>--}}
{{--    <a @if ($route) href="{{ $route }}" @endif {{ $attributes->class([--}}
{{--            'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition',--}}
{{--            'text-primary hover:bg-primary-100' => !$activated,--}}
{{--            'bg-primary text-white' => $activated,--}}
{{--        ]) }}>--}}
{{--        {{ $label ?? $slot }}--}}
{{--    </a>--}}
{{--</li>--}}

@if ($grouped)
    <li x-data="{ show : false }">
        <div>
            <button x-on:click="show = !show"
                    type="button"
                    class="flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm/6 font-semibold text-gray-700 hover:bg-gray-50">
                @if ($icon instanceof \Illuminate\View\ComponentSlot)
                    {{ $icon }}
                @elseif ($icon)
                    <x-dynamic-component :component="TallStackUi::prefix('icon')"
                                         :icon="TallStackUi::icon($icon)"
                                         internal
                                         class="w-6 h-6 shrink-0 text-gray-400" />
                @endif
                {{ $label }}
                <x-tallstack-ui::icon.generic.chevron-right class="ml-auto w-4 h-4 shrink-0 text-gray-400"
                                                            x-bind:class="{
                                                                'rotate-90 text-gray-500': show,
                                                                'text-gray-400': !show
                                                            }" />
            </button>
            <ul x-show="show" class="mt-1 px-2">
                {{ $slot }}
            </ul>
        </div>
    </li>
@else
    <li>
        <a @if ($route) href="{{ $route }}" @endif class="group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold text-gray-700 hover:bg-gray-50 cursor-pointer">
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
