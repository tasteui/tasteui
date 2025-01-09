<?php

namespace TallStackUi\View\Components\Layout\SideBar;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\ComponentSlot;
use TallStackUi\Foundation\Attributes\SoftPersonalization;
use TallStackUi\Foundation\Personalization\Contracts\Personalization;
use TallStackUi\TallStackUiComponent;

#[SoftPersonalization('layout.side-bar.item')]
class Item extends TallStackUiComponent implements Personalization
{
    public function __construct(
        public ?string $text = null,
        public ?string $route = null,
        public ComponentSlot|string|null $icon = null,
        public ComponentSlot|string|null $collapseIcon = null,
        public ?bool $current = null,
        public ?bool $opened = null,
        public ?bool $grouped = null,
        public ?bool $navigate = null,
        public ?bool $navigateHover = null
    ) {
        //
    }

    public function blade(): View
    {
        return view('tallstack-ui::components.layout.sidebar.item');
    }

    public function personalization(): array
    {
        return Arr::dot([
            'grouped' => [
                'button' => 'flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm font-semibold text-gray-700 hover:bg-gray-100 transition-all',
                'icon' => [
                    'base' => 'w-6 h-6 shrink-0 text-gray-400',
                    'collapse' => [
                        'base' => 'ml-auto w-4 h-4 shrink-0 text-gray-400 transition-all',
                        'rotate' => 'rotate-180 text-gray-500',
                    ],
                ],
                'group' => 'mt-1 px-2 space-y-1',
            ],
            'normal' => [
                'state' => [
                    'base' => 'group flex gap-x-3 rounded-md p-2 text-sm font-semibold transition-all',
                    'deactivated' => 'text-gray-700 hover:text-primary-500 hover:bg-primary-50',
                    'activated' => 'text-primary-500 bg-primary-50',
                ],
                'icon' => [
                    'base' => 'w-6 h-6 shrink-0 group-hover:text-primary-500 transition-all',
                    'deactivated' => 'text-gray-400',
                    'activated' => 'text-primary-500',
                ],
            ],
        ]);
    }
}
