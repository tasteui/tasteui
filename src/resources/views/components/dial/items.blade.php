@php
    $personalize = $classes();
@endphp

<{{ $tag }} @if ($href) href="{{ $href }}" @else type="{{ $attributes->get('type', 'button') }}" @endif
    {{ $attributes->except('type')->class([
        $personalize['button'],
        'rounded-full' => !$square,
        'rounded-lg' => $square,
        'flex-col' => $label
    ]) }}>
    <x-dynamic-component :component="TallStackUi::component('icon')"
            :icon="TallStackUi::icon($icon)"
            @class([
                $personalize['icon'],
                'mb-1' => $label
            ]) />
            
    @if ($label)
        <span @class($personalize['label'])>{{ $label }}</span>
        <span class="sr-only">{{ $label }}</span>
    @endif
</{{ $tag }}>