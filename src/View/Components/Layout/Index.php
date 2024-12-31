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
        public ?ComponentSlot $header,
        public ?ComponentSlot $left,
        public ?ComponentSlot $footer,
    ) {
        //
    }

    public function blade(): View
    {
        return view('tallstack-ui::components.layout.index');
    }

    public function personalization(): array
    {
        return Arr::dot([]);
    }
}
