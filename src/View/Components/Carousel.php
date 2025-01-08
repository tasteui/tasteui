<?php

namespace TallStackUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use TallStackUi\Foundation\Attributes\SoftPersonalization;
use TallStackUi\Foundation\Personalization\Contracts\Personalization;
use TallStackUi\TallStackUiComponent;

#[SoftPersonalization('carousel')]
class Carousel extends TallStackUiComponent implements Personalization
{
    public function __construct(
        public Collection|array|null $images = null,
        public ?int $cover = null,
        public ?bool $autoplay = null,
        public ?int $interval = 3,
        public ?bool $withoutIndicators = null,
        public ?bool $stopOnHover = null,
        public ?string $wrapper = null,
    ) {
        $this->images = collect($this->images);

        $this->cover ??= $this->images->where('cover', '=', true)->keys()->values()->first() + 1 ?? 1;

        $this->images = $this->images->toArray();

        $this->interval = $this->interval * 1000;
    }

    public function blade(): View
    {
        return view('tallstack-ui::components.carousel');
    }

    public function personalization(): array
    {
        return Arr::dot([]);
    }

    protected function validate(): void
    {
        if (blank($this->images)) {
            throw new InvalidArgumentException('The [carousel] images attribute is required.');
        }
    }
}
