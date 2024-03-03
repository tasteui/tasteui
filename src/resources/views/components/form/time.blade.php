@php
    [$property, $error, $id, $entangle] = $bind($attributes, $errors ?? null, $livewire);
    $personalize = $classes();
    $value = $attributes->get('value');
@endphp

@if (!$livewire && $property)
    <input hidden id="{{ $id }}" name="{{ $property }}">
@endif

<div x-data="tallstackui_formTime(
    {!! $entangle !!},
    @js($format === '24'),
    @js($livewire),
    @js($property),
    @js($value))"
    {{ $attributes->only(['x-on:hour', 'x-on:minute']) }}
    x-cloak x-on:click.outside="show = false">
    <x-dynamic-component :component="TallStackUi::component('input')"
                         {{ $attributes->except('name') }}
                         :$label
                         :$hint
                         :$invalidate
                         :alternative="$attributes->get('name')"
                         x-ref="input"
                         x-on:click="show = !show"
                         dusk="tallstackui_time_input"
                         class="cursor-pointer caret-transparent">
                         <x-slot:suffix>
                             <div class="flex items-center gap-1">
                                <button type="button" x-on:click="show = !show">
                                    <x-dynamic-component :component="TallStackUi::component('icon')"
                                                         :icon="TallStackUi::icon('clock')"
                                                         @class($personalize['icon']) />
                                </button>
                             </div>
                         </x-slot:suffix>
    </x-dynamic-component>
    <x-dynamic-component :component="TallStackUi::component('floating')" class="p-3 w-[18rem]">
        <div @class(['flex flex-col', 'mb-2' => $helper || $footer->isNotEmpty(), 'w-full' => $format === '24'])>
            <div @class($personalize['wrapper'])>
                <span x-text="formatted.hours" x-ref="hours"@class($personalize['time'])></span>
                <span @class($personalize['separator'])>:</span>
                <span x-text="formatted.minutes" x-ref="minutes" @class($personalize['time'])></span>
                @if ($format === '12')
                    <div @class($personalize['interval.wrapper'])>
                        <p @class($personalize['interval.text']) x-text="interval"></p>
                    </div>
                @endif
            </div>
            <div wire:ignore.self @class($personalize['helper.wrapper'])>
                <input type="range"
                       min="{{ $format === '12' ? 1 : 0 }}"
                       max="{{ $format === '12' ? 12 : 23 }}"
                       step="{{ $stepHour ?? 1 }}"
                       x-model="hours"
                       dusk="tallstackui_time_hours"
                       x-on:mouseenter="$refs.hours.classList.add('{{ $personalize['range.light'] }}', '{{ $personalize['range.dark'] }}')"
                       x-on:mouseleave="$refs.hours.classList.remove('{{ $personalize['range.light'] }}', '{{ $personalize['range.dark'] }}')"
                       @class(['focus:outline-none', $personalize['range.base'], $personalize['range.thumb']])>
                <input type="range"
                       min="0"
                       max="59"
                       step="{{ $stepMinute ?? 1 }}"
                       x-model="minutes"
                       dusk="tallstackui_time_minutes"
                       x-on:mouseenter="$refs.minutes.classList.add('{{ $personalize['range.light'] }}', '{{ $personalize['range.dark'] }}')"
                       x-on:mouseleave="$refs.minutes.classList.remove('{{ $personalize['range.light'] }}', '{{ $personalize['range.dark'] }}')"
                       @class(['focus:outline-none', $personalize['range.base'], $personalize['range.thumb']])>
            </div>
            @if ($format === '12')
                <div @class($personalize['interval.buttons.wrapper'])>
                    <button type="button"
                            x-on:click="select('AM')"
                            @class($personalize['interval.buttons.am'])
                            dusk="tallstackui_time_am">AM</button>
                    <button type="button"
                            x-on:click="select('PM')"
                            @class($personalize['interval.buttons.pm'])
                            dusk="tallstackui_time_pm">PM</button>
                </div>
            @endif
        </div>
        @if ($helper || $footer)
            <x-slot:footer>
                @if ($helper)
                <x-dynamic-component :component="TallStackUi::component('button')"
                                     :text="__('tallstack-ui::messages.time.helper')"
                                     type="button"
                                     @class([$personalize['helper.button'], 'mt-2' => $format === '24'])
                                     x-on:click="current()"
                                     {{ $attributes->only('x-on:current') }}
                                     dusk="tallstackui_time_current"
                                     xs />
                @endif
                @if ($footer)
                    {{ $footer }}
                @endif
            </x-slot:footer>
        @endif
    </x-dynamic-component>
</div>
