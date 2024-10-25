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
            'white' => 'bg-white border-white focus:ring-white-300',
            'black' => 'bg-black border-black focus:ring-black-300',
            'primary' => 'bg-primary-500 border-primary-500 focus:ring-primary-300',
            'secondary' => 'bg-secondary-500 border-secondary-500 focus:ring-secondary-300',
            'slate' => 'bg-slate-500 border-slate-500 focus:ring-slate-300',
            'gray' => 'bg-gray-500 border-gray-500 focus:ring-gray-300',
            'zinc' => 'bg-zinc-500 border-zinc-500 focus:ring-zinc-300',
            'neutral' => 'bg-neutral-500 border-neutral-500 focus:ring-neutral-300',
            'stone' => 'bg-stone-500 border-stone-500 focus:ring-stone-300',
            'red' => 'bg-red-500 border-red-500 focus:ring-red-300',
            'orange' => 'bg-orange-500 border-orange-500 focus:ring-orange-300',
            'amber' => 'bg-amber-500 border-amber-500 focus:ring-amber-300',
            'yellow' => 'bg-yellow-500 border-yellow-500 focus:ring-yellow-300',
            'lime' => 'bg-lime-500 border-lime-500 focus:ring-lime-300',
            'green' => 'bg-green-500 border-green-500 focus:ring-green-300',
            'emerald' => 'bg-emerald-500 border-emerald-500 focus:ring-emerald-300',
            'teal' => 'bg-teal-500 border-teal-500 focus:ring-teal-300',
            'cyan' => 'bg-cyan-500 border-cyan-500 focus:ring-cyan-300',
            'sky' => 'bg-sky-500 border-sky-500 focus:ring-sky-300',
            'blue' => 'bg-blue-500 border-blue-500 focus:ring-blue-300',
            'indigo' => 'bg-indigo-500 border-indigo-500 focus:ring-indigo-300',
            'violet' => 'bg-violet-500 border-violet-500 focus:ring-violet-300',
            'purple' => 'bg-purple-500 border-purple-500 focus:ring-purple-300',
            'fuchsia' => 'bg-fuchsia-500 border-fuchsia-500 focus:ring-fuchsia-300',
            'pink' => 'bg-pink-500 border-pink-500 focus:ring-pink-300',
            'rose' => 'bg-rose-500 border-rose-500 focus:ring-rose-300',
        ];
    }
}
