@php
    $tag = $href ? 'a' : 'button';
    $customize = tallstackui_personalization('button', $personalization());
@endphp

<{{ $tag }} @if ($href) href="{{ $href }}" @else
    role="button"
@endif {{ $attributes->class([
        $customize['wrapper.class'],
        $customize['wrapper.sizes.xs'] => $size === 'xs',
        $customize['wrapper.sizes.sm'] => $size === 'sm',
        $customize['wrapper.sizes.md'] => $size === 'md',
        $customize['wrapper.sizes.lg'] => $size === 'lg',
        $colors['wrapper.color'],
        'rounded' => !$square && !$round,
        'rounded-full' => !$square && $round !== null,
    ]) }}
    wire:loading.attr="disabled"
    wire:loading.class="!cursor-wait">
    @if ($icon && $position === 'left')
        <x-icon :$icon @class([
                $customize['icon.sizes.xs'] => $size === 'xs',
                $customize['icon.sizes.sm'] => $size === 'sm',
                $customize['icon.sizes.md'] => $size === 'md',
                $customize['icon.sizes.lg'] => $size === 'lg',
                $colors['icon.color']
            ]) />
    @endif
    {{ $text ?? $slot }}
    @if ($icon && $position === 'right')
        <x-icon :$icon @class([
                $customize['icon.sizes.xs'] => $size === 'xs',
                $customize['icon.sizes.sm'] => $size === 'sm',
                $customize['icon.sizes.md'] => $size === 'md',
                $customize['icon.sizes.lg'] => $size === 'lg',
                $colors['icon.color']
            ]) />
    @endif
    @if ($loading)
        <svg @if ($loading !== "1") wire:target="{{ $loading }}" @endif
             wire:loading.delay{{ $delay ? ".{$delay}" : "" }}
             @class([
                'animate-spin',
                $customize['icon.loading.sizes.xs'] => $size === 'xs',
                $customize['icon.loading.sizes.sm'] => $size === 'sm',
                $customize['icon.loading.sizes.md'] => $size === 'md',
                $customize['icon.loading.sizes.lg'] => $size === 'lg',
                $colors['icon.loading.color'],
             ])
             dusk="button-loading-spinner"
             xmlns="http://www.w3.org/2000/svg"
             fill="none"
             viewBox="0 0 24 24">
            <circle class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4"></circle>
            <path class="opacity-75"
                  fill="currentColor"
                  d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    @endif
</{{ $tag }}>