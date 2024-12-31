<?php

namespace TallStackUi\View\Components\Layout;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\ComponentSlot;
use TallStackUi\Foundation\Attributes\ColorsThroughOf;
use TallStackUi\Foundation\Attributes\SkipDebug;
use TallStackUi\Foundation\Attributes\SoftPersonalization;
use TallStackUi\Foundation\Personalization\Contracts\Personalization;
use TallStackUi\Foundation\Support\Colors\Components\ProgressColors;
use TallStackUi\TallStackUiComponent;
use TallStackUi\View\Components\Progress\Traits\Setup;

#[SoftPersonalization('layout.index')]
#[ColorsThroughOf(ProgressColors::class)]
class Index extends TallStackUiComponent implements Personalization
{
    public function __construct()
    {
        //
    }

    public function blade(): View
    {
        return view('tallstack-ui::components.layout.index');
    }

    public function personalization(): array
    {
        return Arr::dot([])
    }
}
