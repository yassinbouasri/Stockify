<div>
    <x-label>
        <button type="button" wire:click="openModal"
                class="hover:underline text-indigo-700 dark:text-indigo-400">Select Products...
        </button>
    </x-label>
    <x-modal wire:model="show">
{{--        <form wire:submit="">--}}
{{--            <div class=" mx-4 my-4">--}}
{{--                <x-label class="p-1">Product:</x-label>--}}
{{--                <x-input type="search" class="w-1/2 p-1"--}}
{{--                         wire:model.live="query"--}}
{{--                         placeholder="Type A Name Or sku.."--}}
{{--                />--}}

{{--            </div>--}}
{{--            <div>--}}

{{--                <x-search-results-section>--}}
{{--                    @foreach($this->searchedProducts as $product)--}}
{{--                        <a--}}

{{--                            wire:click="selectProduct({{ $product->id }})"--}}
{{--                            href="#"--}}
{{--                            class="dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 font-bold">--}}
{{--                            {{ $product->name . ' || ' . $product->sku  .'|' .$product->id }}--}}
{{--                        </a>--}}
{{--                        <br/>--}}
{{--                    @endforeach--}}
{{--                </x-search-results-section>--}}
{{--            </div>--}}
{{--            <div class=" mx-4 my-4">--}}
{{--                <x-label class="p-1">Quantity:</x-label>--}}
{{--                <x-input type="number" class="w-1/2 p-1"--}}
{{--                         wire:model.live="quantity"--}}
{{--                         placeholder="Type A Name Or sku.."--}}
{{--                />--}}

{{--            </div>--}}

{{--            <div class=" mx-4 my-4">--}}
{{--                <x-button>Select Product</x-button>--}}
{{--            </div>--}}
{{--        </form>--}}
        <div class="dark:bg-gray-800 bg-white mx-4 my-4">
            <div class="flex justify-between mt-2 mb-4">
                <x-input wire:model.live.debounce="query" autofocus type="search" placeholder="Search..."/>
            </div>

            <table class="table-auto w-full max-w-6xl mx-auto my-3">
                <thead class="bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-400 shadow text-left" style="text-align: left !important;">
                <tr class="">
                    <th></th>
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

                    <tr wire:click="selectedProduct({{ $product->id }})" class="cursor-pointer border-b dark:border-gray-600 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td ><x-checkbox class="mx-1 my-1 mr-2"></x-checkbox></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ str($product->description)->words(2) }}</td>

                        <td
                        @forelse($product->stocks as $stock)
                            <span wire:key="stock-{{ $stock->id }}">
                        <livewire:stock-quantity
                            :$stock
                            wire:key="stock-quantity-{{ $stock->id}}"
                        />

                            </span>
                        @empty
                            <span>
                        <p>0</p>
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
                    {{ $this->searchedProducts->onEachSide(1)->links() }}
                </div>



        </div>

    </x-modal>
</div>
