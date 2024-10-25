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
            'button' => 'focus:shadow-outline text-md dark:focus:ring-offset-dark-900 group inline-flex h-14 w-14 items-center justify-center gap-x-2 border border-transparent outline-none transition-all duration-200 ease-in-out hover:shadow-sm focus:border-transparent focus:ring-2 focus:ring-offset-2 focus:ring-offset-white disabled:cursor-not-allowed disabled:opacity-80',
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
