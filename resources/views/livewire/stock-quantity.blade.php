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
    </div>
</div>
