<?php

namespace TallStackUi\View\Components\Dial;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use TallStackUi\Foundation\Attributes\ColorsThroughOf;
use TallStackUi\Foundation\Attributes\SoftPersonalization;
use TallStackUi\Foundation\Personalization\Contracts\Personalization;
use TallStackUi\Foundation\Support\Colors\Components\DialColors;
use TallStackUi\TallStackUiComponent;

#[SoftPersonalization('dial')]
#[ColorsThroughOf(DialColors::class)]
class Dial extends TallStackUiComponent implements Personalization
{
    public function __construct(
        public ?string $icon = null,
        public ?bool $square = false,
        public ?string $position = 'bottom-right',
        public ?string $color = 'primary',
        public ?bool $horizontal = false,
        public ?bool $hover = false,
    ) {
        //
    }

    public function blade(): View
    {
        return view('tallstack-ui::components.dial.dial');
    }

    public function personalization(): array
    {
        return Arr::dot([
            'icon' => 'w-5 h-5 transition-transform',
            'button' => 'flex items-center justify-center text-white w-14 h-14 focus:ring-4 focus:ring-primary-300 focus:outline-none',
            'position' => [
                'top-left' => 'fixed top-6 start-6 group',
                'top-right' => 'fixed top-6 end-6 group',
                'bottom-left' => 'fixed bottom-6 start-6 group',
                'bottom-right' => 'fixed end-6 bottom-6 group',
            ],
            'items' => 'flex items-center gap-2',
        ]);
    }
}
