<div x-data="tallstackui_carousel(@js($images), @js($cover), @js($autoplay), @js($interval))"
     {{ $attributes->only(['x-on:next', 'x-on:previous']) }}
     x-ref="carousel">
    @if ($header)
        {{ $header }}
    @endif
    <div class="relative w-full overflow-hidden">
        @if (!$autoplay)
            <button type="button"
                    class="absolute left-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-slate-700 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:outline-offset-0 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:bg-slate-900/60 dark:focus-visible:outline-blue-600"
                    x-on:click="previous()">
                <x-dynamic-component :component="TallStackUi::prefix('icon')"
                                     :icon="TallStackUi::icon('chevron-left')"
                                     internal
                                     class="w-6 h-6 pr-0.5" />
            </button>
            <button type="button"
                    class="absolute right-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-slate-700 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:outline-offset-0 dark:bg-slate-900/40 dark:text-slate-300 dark:hover:bg-slate-900/60 dark:focus-visible:outline-blue-600"
                    x-on:click="next()">
                <x-dynamic-component :component="TallStackUi::prefix('icon')"
                                     :icon="TallStackUi::icon('chevron-right')"
                                     internal
                                     class="w-6 h-6 pl-0.5" />
            </button>
        @endif
        <div @class([
            'relative w-full',
            'min-h-[50svh]' => is_null($wrapper),
            $wrapper => ! is_null($wrapper),
        ])>
            <template x-for="(image, index) in images" :key="index">
                <div x-show="current == index + 1" class="absolute inset-0" x-transition.opacity.duration.1000ms>
                    <a x-bind:href="image.url ?? '#'" x-bind:target="image.target">
                        <template x-if="image.title">
                            <div @class([
                                'lg:px-32 lg:py-14 absolute inset-0 z-10 flex flex-col items-center justify-end gap-2 bg-gradient-to-t from-slate-900/85 to-transparent px-16 py-12 text-center',
                                'rounded-xl' => $round,
                            ])>
                                <h3 class="w-full text-balance text-2xl lg:text-3xl font-bold text-white" x-text="image.title"></h3>
                                <p class="text-sm text-white" x-text="image.description"></p>
                            </div>
                        </template>
                        <img @class(['absolute w-full h-full inset-0 object-cover text-slate-700 dark:text-slate-300', 'rounded-xl' => $round])
                             x-bind:src="image.src"
                             x-bind:alt="image.alt"
                             @if ($autoplay && $stopOnHover)
                                 x-on:mouseover="(paused = !paused), reset()"
                             x-on:mouseleave="(paused = !paused), reset()"
                                @endif />
                    </a>
                </div>
            </template>
        </div>
        @if (!$withoutIndicators)
            <div class="absolute rounded-xl bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 bg-white/75 px-1.5 py-1 md:px-2 dark:bg-slate-900/75" role="group" aria-label="slides">
                <template x-for="(image, index) in images">
                    <button class="size-2 cursor-pointer rounded-full transition bg-slate-700 dark:bg-slate-300" x-on:click="(current = index + 1), reset()" x-bind:class="[current === index + 1 ? 'bg-slate-700 dark:bg-slate-300' : 'bg-slate-700/50 dark:bg-slate-300/50']" x-bind:aria-label="'slide ' + (index + 1)"></button>
                </template>
            </div>
        @endif
    </div>
    @if ($footer)
        {{ $footer }}
    @endif
</div>
