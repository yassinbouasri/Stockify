<div
    x-data="{ editing: false }"
    x-on:click="editing = true"
    class="relative"
>
    <span x-show="!editing" class="cursor-pointer">
        {{ $quantity }}
    </span>

    <div x-show="editing" class="absolute top-0 left-0">
        <input
            autofocuse
            x-cloak
            type="number"
            wire:model.live="quantity"
            wire:change="updateQuantity"
            x-on:keydown.enter="editing = false"
            x-on:keydown.escape="editing = false"
            x-on:keydown.arrow-up="quantity++"
            x-on:keydown.arrow-down="quantity--"
            x-on:blur="editing = false"
            class="w-20 h-6 mt-0 mb-5 border rounded shadow-sm text-sm bg dark:bg-gray-700"
            autofocus
            min="0"
        >
        <div wire:loading wire:target="updateQuantity" class="ml-2">
            <svg class="animate-spin h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>
</div>
