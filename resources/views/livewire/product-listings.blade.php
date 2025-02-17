<div class="dark:bg-gray-800 bg-white">
<x-slot:header>Product List</x-slot:header>
    <div class="flex justify-between mt-2 mb-4">
        <a wire:navigate href="{{ route('create-product') }}"
           class="px-3 mt-1 ml-6 inline-flex items-center py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">Add New</a>
        <x-input wire:model.live.debounce="query" autofocus type="search" placeholder="Search..."/>
    </div>

    <table class="table-auto w-full max-w-6xl mx-auto my-3">
        <thead class="bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-400 shadow text-left" style="text-align: left !important;">
        <tr class="">
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>SKU</th>
            <th>Description</th>
            <th>Quantity</th>
            <th></th>
        </tr>
        </thead>
        <tbody class="text-gray-700 dark:text-gray-400">
        @foreach($this->searchedProducts as $product)
            <tr class="border-b dark:border-gray-600 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ str($product->description)->words(3) }}</td>

                <td
                @forelse($product->stocks as $stock)
                    @if($stock->quantity <= 10)
                        <span wire:key="stock-{{ $stock->id }}" class="text-red-800">
                        <livewire:stock-quantity
                                :$stock
                                wire:key="stock-quantity-{{ $stock->id}}"
                        />
                        </span>
                        @else
                        <span wire:key="stock-{{ $stock->id }}" >
                        <livewire:stock-quantity
                                :$stock
                                wire:key="stock-quantity-{{ $stock->id}}"
                        />
                        </span>
                    @endif

                @empty
                    <span>
                        <p></p>
                        @endforelse
                    </span>
                    <td class="flex gap-1">
                        {{--                    <button wire:click="$dispatch('preview-image', { url: '{{ $product->image }}' })">--}}
                        <button wire:click="previewImage('{{$product->image}}')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"/>
                            </svg>
                        </button>
                        <a href="{{ route('update-product', $product) }}" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                            </svg>

                        </a>
                        <button
                            wire:click.prevent="delete({{$product->id}})"
                            wire:confirm="Are you sure you want to delete this product?"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                            </svg>


                        </button>

                    </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <livewire:image-preview/>

    <div class="mx-3 my-3 mt-4 mb-4">
        {{ $this->searchedProducts->links() }}
    </div>

</div>
