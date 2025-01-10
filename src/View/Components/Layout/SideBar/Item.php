<?php

namespace TallStackUi\View\Components\Layout\SideBar;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
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
        public ?string $match = null,
        public ComponentSlot|string|null $icon = null,
        public ComponentSlot|string|null $collapseIcon = null,
        public ?bool $current = null,
        public ?bool $opened = null,
        public ?bool $grouped = null,
    ) {
        //
    }

    public function blade(): View
    {
        return view('tallstack-ui::components.layout.sidebar.item');
    }

    final public function matches(): bool
    {
        if ($this->route) {
            $app = config('app.url');
            $str = str($this->route);

            // If start with / and does not contain the app.url,
            // then we assume it is a basic url: /dashboard
            if ($str->startsWith('/') && ! $str->contains($app)) {
                return url($this->route) === url(request()->url());
            }

            $route = Route::getCurrentRoute();

            // If contains the app.url, then we assume it is a
            // route created in the route helper: route('dashboard')
            return $this->route === route($route->getName(), $route->parameters());
        }

        return $this->match && request()->routeIs($this->match);
    }

    public function personalization(): array
    {
        return Arr::dot([
            'group' => [
                'button' => 'flex w-full items-center gap-x-3 rounded-md p-2 text-left text-sm font-semibold text-primary-500 hover:bg-primary-50/50 transition-all',
                'icon' => [
                    'base' => 'w-6 h-6 shrink-0 text-primary-500',
                    'collapse' => [
                        'base' => 'ml-auto w-4 h-4 shrink-0 text-primary-500 transition-all',
                        'rotate' => 'rotate-180 text-primary-500',
                    ],
                ],
                'group' => 'mt-1 px-2 pl-5',
            ],
            'item' => [
                'wrapper' => 'border-l pl-2 py-0.5 border-outline',
                'state' => [
                    'base' => 'group flex items-center gap-x-3 rounded-md p-2 text-sm font-semibold transition-all',
                    'current' => 'text-primary-500 bg-primary-50',
                    'normal' => 'text-primary-500 hover:bg-primary-50/50',
                ],
                'icon' => 'w-6 h-6 shrink-0 text-primary-500 transition-all',
            ],
        ]);
    }
}
