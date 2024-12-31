<div x-data="{ mobile : false }">
    @if ($sidebar->isNotEmpty())
        <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" x-show="mobile">
            <div x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-900/80" x-show="mobile"></div>
            <div class="fixed inset-0 flex">
                <div x-transition:enter="transition ease-in-out duration-300 transform"
                     x-transition:enter-start="-translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transition ease-in-out duration-300 transform"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="-translate-x-full"
                     class="relative mr-16 flex w-full max-w-xs flex-1" x-show="mobile">
                    <div x-on:click.outside="mobile = false"
                         x-show="mobile"
                         x-transition:enter="ease-in-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="ease-in-out duration-300"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <button x-on:click="mobile = false" type="button" class="-m-2.5 p-2.5">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4" x-on:click.outside="mobile = false">
                        <div class="mt-16 flex h-16 shrink-0 items-center">
                            <nav class="flex h-16 flex-1 flex-col">
                                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                    <li>
                                        <ul role="list" class="-mx-2 space-y-1">
                                            {{ $sidebar }}
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
            <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4">
                <div class="mt-16 flex h-16 shrink-0 items-center">
                    <nav class="flex h-16 flex-1 flex-col">
                        <ul role="list" class="flex flex-1 flex-col gap-y-7">
                            <li>
                                <ul role="list" class="-mx-2 space-y-1">
                                    {{ $sidebar }}
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    @endif
    <div class="min-h-full">
        <div class="lg:pl-72">
            @if ($header)
                {{ $header }}
            @endif
            <main class="max-w-full mx-auto sm:px-6 lg:px-8 py-10">
                <div class="px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    @if ($footer)
        {{ $footer }}
    @endif
</div>
