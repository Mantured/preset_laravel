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
<div class="mt-10">
    <nav role="navigation" aria-label="{{ __('pagination.label') }}" class="md:ml-auto flex items-center justify-end gap-2">
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
    </nav>
</div>
@endif
