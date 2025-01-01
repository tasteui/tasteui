<?php

namespace TallStackUi\View\Components\Layout;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\ComponentSlot;
use TallStackUi\Foundation\Attributes\SoftPersonalization;
use TallStackUi\Foundation\Personalization\Contracts\Personalization;
use TallStackUi\TallStackUiComponent;

#[SoftPersonalization('layout.index')]
class Index extends TallStackUiComponent implements Personalization
{
    public function __construct(
        public ?ComponentSlot $top = null,
        public ?ComponentSlot $header = null,
        public ?ComponentSlot $brand = null,
        public ?ComponentSlot $sidebar = null,
        public ?ComponentSlot $footer = null,
    ) {
        //
    }

    public function blade(): View
    {
        return view('tallstack-ui::components.layout.index');
    }

    public function personalization(): array
    {
        return Arr::dot([
            'wrapper' => [
                'first' => 'min-h-full',
                'second' => 'md:pl-72',
            ],
            'main' => 'max-w-full mx-auto p-10',
        ]);
    }
}
