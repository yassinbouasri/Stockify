<div>
    <x-label>
        <button type="button" wire:click="openModal" class="hover:underline text-indigo-700 dark:text-indigo-400">Select Products...</button>
    </x-label>
    <x-modal wire:model="show">
{{--        <form wire:submit="select">--}}
            <div class=" mx-4 my-4">
                <x-label class="p-1">Product:</x-label>
                <x-input type="search" class="w-1/2 p-1"
                         wire:model.live="searchProduct"
                         placeholder="Type A Name Or sku.."
                />

            </div>
            <div>
                @if($this->searchedProducts)
                    @foreach($this->searchedProducts as $product)
                        {{ $product }}
                    @endforeach
                @endif
            </div>

            <div class=" mx-4 my-4">
                <x-button>Select Product</x-button>
            </div>
{{--        </form>--}}

    </x-modal>
</div>
