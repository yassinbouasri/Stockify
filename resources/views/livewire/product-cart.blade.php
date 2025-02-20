<div class="font-medium text-sm text-gray-700 dark:text-gray-300">
    @if((count($this->productList) > 0) || (count($this->products) > 0))
    <table class="table-auto w-full">
        <thead class="bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-400 shadow text-left" style="text-align: left !important;">
        <tr>
            <th class="text-left">Name</th>
            <th class="text-left">SKU</th>
            <th class="text-left">Price</th>
            <th class="text-left">Quantity</th>
        </tr>
        </thead>
        <tbody class="text-gray-700 dark:text-gray-400">
        @php
        $productCollection = (count($this->productList) > 0) ? $this->productList : $this->products;
        @endphp
        @foreach($productCollection as $product)
            <tr>
                <td class="px-1">{{ $product->name }}</td>
                <td class="px-1">{{ $product->sku }}</td>
                <td class="px-1">{{ $product->price }}</td>
                <td class="px-1">
                            <x-input

                                wire:key="stock-{{ $product->id ?? 0 }}"
                                wire:model="quantities.{{ $product->id ?? 0 }}"
                                type="number"
                                min="1"
                                max="{{ $this->maxQuantities[$product->id] ?? 0 }}"
                                value="1"
                                class="w-20 h-7  rounded-md py-2  px-1 mt-1"
                            />
                </td>
            </tr>

        @endforeach

        </tbody>

    </table>
        <diV>
{{--            {{ $this->productList->onEachSide(1)->links() }}--}}
        </diV>

    @endif
</div>
