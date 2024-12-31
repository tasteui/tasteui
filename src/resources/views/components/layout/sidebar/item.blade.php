<li>
    <a @if ($route) href="{{ $route }}" @endif {{ $attributes->class([
            'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition',
            'text-primary hover:bg-primary-100' => !$activated,
            'bg-primary text-white' => $activated,
        ]) }}>
        {{ $label ?? $slot }}
    </a>
</li>
