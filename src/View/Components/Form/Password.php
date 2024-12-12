<?php

namespace TallStackUi\View\Components\Form;

use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use TallStackUi\Foundation\Attributes\PassThroughRuntime;
use TallStackUi\Foundation\Attributes\SoftPersonalization;
use TallStackUi\Foundation\Personalization\Contracts\Personalization;
use TallStackUi\Foundation\Support\Runtime\Components\PasswordRuntime;
use TallStackUi\TallStackUiComponent;
use TallStackUi\View\Components\Floating;

#[SoftPersonalization('form.password')]
#[PassThroughRuntime(PasswordRuntime::class)]
class Password extends TallStackUiComponent implements Personalization
{
    public function __construct(
        public ?string $label = null,
        public ?string $hint = null,
        public Collection|array|null $rules = null,
        public ?bool $mixedCase = false,
        public ?bool $generator = false,
        public ?bool $invalidate = null
    ) {
        //
    }

    public function blade(): View
    {
        return view('tallstack-ui::components.form.password');
    }

    public function personalization(): array
    {
        return Arr::dot([
            'icon' => [
                'wrapper' => 'flex items-center',
                'class' => 'h-5 w-5 cursor-pointer',
            ],
            'floating' => [
                'default' => collect(app(Floating::class)->personalization())->get('wrapper'),
                'class' => 'w-full p-3',
            ],
            'rules' => [
                'title' => 'text-md font-semibold text-red-500 dark:text-dark-300',
                'block' => 'mt-2 flex flex-col',
                'items' => [
                    'base' => 'inline-flex items-center gap-1 text-gray-700 text-sm dark:text-dark-300',
                    'icons' => [
                        'error' => 'h-5 w-5 text-red-500',
                        'success' => 'h-5 w-5 text-green-500',
                    ],
                ],
            ],
        ]);
    }

    protected function setup(): void
    {
        $this->rules = collect($this->rules ?? config('tallstackui.settings.form.password.rules'))->mapWithKeys(function (string $value, ?string $key = null): array {
            if (is_null($this->rules)) {
                return match ($key) {
                    'min' => ['min' => $value],
                    'numbers' => ['numbers' => (bool) $value],
                    'mixed' => ['mixed' => (bool) $value],
                    'symbols' => ['symbols' => $value],
                    default => [],
                };
            }

            return match (true) {
                str_contains($value, 'min') => ['min' => explode(':', $value)[1]],
                str_contains($value, 'numbers') => ['numbers' => true],
                str_contains($value, 'symbols') => ['symbols' => explode(':', $value)[1]],
                str_contains($value, 'mixed') => ['mixed' => true],
                default => [],
            };
        });
    }

    /** @throws Exception */
    protected function validate(): void
    {
        if ($this->generator && $this->rules->isEmpty()) {
            throw new Exception('The password [generator] requires the [rules] of the password.');
        }
    }
}
