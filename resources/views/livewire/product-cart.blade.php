<div class="font-medium text-sm text-gray-700 dark:text-gray-300">
    @if(count($this->productList) > 0)
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
        @foreach($this->productList as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
                        </svg>
                    </button>
                </td>
            </tr>

        @endforeach

        </tbody>

    </table>
    @endif
</div>
