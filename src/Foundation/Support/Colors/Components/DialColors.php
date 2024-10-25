<?php

namespace TallStackUi\Foundation\Support\Colors\Components;

use TallStackUi\Foundation\Support\Colors\Concerns\SetupColors;

class DialColors
{
    use SetupColors;

    public function colors(): array
    {
        $getter = $this->component->color; // @phpstan-ignore-line

        return ['background' => data_get($this->get('background'), $getter) ?? data_get($this->background(), $getter)];
    }

    private function background(): array
    {
        return [
            'white' => 'bg-white border-white focus:ring-white-500',
            'black' => 'bg-black border-black focus:ring-black-500',
            'primary' => 'bg-primary-500 border-primary-500 text-white focus:ring-primary-500',
            'secondary' => 'bg-secondary-500 border-secondary-500 focus:ring-secondary-500',
            'slate' => 'bg-slate-500 border-slate-500 focus:ring-slate-500',
            'gray' => 'bg-gray-500 border-gray-500 focus:ring-gray-500',
            'zinc' => 'bg-zinc-500 border-zinc-500 focus:ring-zinc-500',
            'neutral' => 'bg-neutral-500 border-neutral-500 focus:ring-neutral-500',
            'stone' => 'bg-stone-500 border-stone-500 focus:ring-stone-500',
            'red' => 'bg-red-500 border-red-500 focus:ring-red-500',
            'orange' => 'bg-orange-500 border-orange-500 focus:ring-orange-500',
            'amber' => 'bg-amber-500 border-amber-500 focus:ring-amber-500',
            'yellow' => 'bg-yellow-500 border-yellow-500 focus:ring-yellow-500',
            'lime' => 'bg-lime-500 border-lime-500 focus:ring-lime-500',
            'green' => 'bg-green-500 border-green-500 focus:ring-green-500',
            'emerald' => 'bg-emerald-500 border-emerald-500 focus:ring-emerald-500',
            'teal' => 'bg-teal-500 border-teal-500 focus:ring-teal-500',
            'cyan' => 'bg-cyan-500 border-cyan-500 focus:ring-cyan-500',
            'sky' => 'bg-sky-500 border-sky-500 focus:ring-sky-500',
            'blue' => 'bg-blue-500 border-blue-500 focus:ring-blue-500',
            'indigo' => 'bg-indigo-500 border-indigo-500 focus:ring-indigo-500',
            'violet' => 'bg-violet-500 border-violet-500 focus:ring-violet-500',
            'purple' => 'bg-purple-500 border-purple-500 focus:ring-purple-500',
            'fuchsia' => 'bg-fuchsia-500 border-fuchsia-500 focus:ring-fuchsia-500',
            'pink' => 'bg-pink-500 border-pink-500 focus:ring-pink-500',
            'rose' => 'bg-rose-500 border-rose-500 focus:ring-rose-500',
        ];
    }
}
