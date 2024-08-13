@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

@if ($paginator->hasPages())
    <div class="flex flex-col md:flex-row items-center gap-2 md:gap-4 mt-10">
        <div class="text-color-6c757d text-sm">{{ __('common.shown_of', [
                'current' => ($paginator->total() <= $paginator->perPage() ? $paginator->total() : $paginator->lastItem()),
                'total' => $paginator->total()
                ])
             }}
        </div>
        <nav role="navigation" aria-label="{{ __('pagination.label') }}" class="md:ml-auto flex items-center justify-end">
            <div class="flex justify-between flex-1 sm:hidden">
                <span>
                    @if ($paginator->onFirstPage())
                        <span class="relative inline-flex justify-center items-center border border-color-dee2e6 w-10 h-10 rounded-sm">
                            <x-icon name="chevron-left" class="w-4 h-4 fill-color-343a40" />
                        </span>
                    @else
                        <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="relative inline-flex justify-center items-center border border-color-dee2e6 w-10 h-10 rounded-sm hover:bg-color-dee2e6">
                            <x-icon name="chevron-left" class="w-4 h-4 fill-color-343a40" />
                        </button>
                    @endif
                </span>

                <span>
                    @if ($paginator->hasMorePages())
                        <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before" class="relative inline-flex justify-center items-center border border-color-dee2e6 w-10 h-10 rounded-sm hover:bg-color-dee2e6">
                            <x-icon name="chevron-right" class="w-4 h-4 fill-color-343a40" />
                        </button>
                    @else
                        <span class="relative inline-flex justify-center items-center border border-color-dee2e6 w-10 h-10 rounded-sm">
                            <x-icon name="chevron-right" class="w-4 h-4 fill-color-343a40" />
                        </span>
                    @endif
                </span>
            </div>

            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-end text-xs">
                <div>
                    <span class="flex space-x-1.5">
                        <span>
                            {{-- Previous Page Link --}}
                            @if ($paginator->onFirstPage())
                                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                    <span class="relative inline-flex justify-center items-center border border-color-dee2e6 w-10 h-10 rounded-sm opacity-30" aria-hidden="true">
                                        <x-icon name="chevron-left" class="w-4 h-4 fill-color-343a40" />
                                    </span>
                                </span>
                            @else
                                <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" rel="prev" class="relative inline-flex justify-center items-center border border-color-dee2e6 w-10 h-10 rounded-sm hover:bg-color-dee2e6" aria-label="{{ __('pagination.previous') }}">
                                    <x-icon name="chevron-left" class="w-4 h-4 fill-color-343a40" />
                                </button>
                            @endif
                        </span>

                        {{-- Pagination Elements --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span aria-disabled="true">
                                    <span class="relative inline-flex justify-center items-center border border-color-dee2e6 w-10 h-10 rounded-sm">{{ $element }}</span>
                                </span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                        @if ($page == $paginator->currentPage())
                                            <span aria-current="page">
                                                <span class="relative inline-flex justify-center items-center bg-color-004aad text-white w-10 h-10 rounded-sm">{{ $page }}</span>
                                            </span>
                                        @else
                                            <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" class="relative inline-flex justify-center items-center border border-color-dee2e6 w-10 h-10 rounded-sm hover:bg-color-dee2e6" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                                {{ $page }}
                                            </button>
                                        @endif
                                    </span>
                                @endforeach
                            @endif
                        @endforeach

                        <span>
                            {{-- Next Page Link --}}
                            @if ($paginator->hasMorePages())
                                <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" rel="next" class="relative inline-flex justify-center items-center border border-color-dee2e6 w-10 h-10 rounded-sm hover:bg-color-dee2e6" aria-label="{{ __('pagination.next') }}">
                                    <x-icon name="chevron-right" class="w-4 h-4 fill-color-343a40" />
                                </button>
                            @else
                                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                    <span class="relative inline-flex justify-center items-center border border-color-dee2e6 w-10 h-10 rounded-sm opacity-30" aria-hidden="true">
                                        <x-icon name="chevron-right" class="w-4 h-4 fill-color-343a40" />
                                    </span>
                                </span>
                            @endif
                        </span>
                    </span>
                </div>
            </div>
        </nav>
    </div>
@endif
