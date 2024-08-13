<div
    x-data="{ open: false, data: ''}"
    x-ref="notification"
    x-on:open-notification.window="
		open = true;
		data = $event.detail;
		if (!data.disabledClose) {
		    setTimeout(() => open = false, 7000);
		}
	"
    class="fixed inset-0 z-50 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end">
    <div
        x-show="open"
        x-cloak
        x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="w-full max-w-sm overflow-hidden text-white rounded shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5"
        :class="{'bg-color-37be85': data.type === 'success', 'bg-red-500': data.type === 'error', 'bg-amber-500': data.type === 'warning'}"
    >
        <div class="p-4">
            <div class="flex items-start">
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-lg font-medium" x-text="data.title"></p>
                    <p class="mt-1 text-sm" x-text="data.subtitle"></p>
                    <template x-if="data.actions">
                        <div class="mt-2">
                            <template x-if="data.actions.primary">
                                <a :href="data.actions.primary.url" :target="data.actions.primary.target"
                                   class="text-sm font-bold focus:outline-none hover:underline"
                                   x-text="data.actions.primary.label"></a>
                            </template>
                            <button x-on:click="open = false"
                                    class="ml-6 text-sm font-medium focus:outline-none hover:underline">
                                {{ __('common.close') }}
                            </button>
                        </div>
                    </template>
                </div>
                <div class="flex flex-shrink-0 ml-4">
                    <button x-on:click="open = false"
                            class="inline-flex focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="sr-only">{{ __('common.close') }}</span>
                        <x-icon name="close" class="w-5 h-5 fill-color-ffffff" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
