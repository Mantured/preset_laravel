<div>
    @if (isset($title))
        <div class="flex max-md:flex-col items-center justify-between py-6 max-md:space-y-3">
            <h2 class="text-xl font-semibold">
                {{ $title }}
            </h2>
            @if(isset($actions))
                <div class="flex items-center space-x-2">
                    {{ $actions }}
                </div>
            @endif
        </div>
    @endif
    {{ $slot }}
</div>
