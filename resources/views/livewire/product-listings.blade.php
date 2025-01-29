<div>
    <table class="table-auto w-full">
        <thead class="bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-400 ">
        <tr class="text-left">
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Category</th>
            <th>SKU</th>
        </tr>
        </thead>
        <tbody class="text-gray-700 dark:text-gray-400">
        @foreach($this->products as $product)
            <tr class="border-b dark:border-gray-600 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                <td >{{ $product->name }}</td>
                <td >{{ $product->price }}</td>
                <td >{{ str($product->description)->words(2) }}</td>
                <td >{{ $product->quantity }}</td>
                <td >{{ $product->category->name }}</td>
                <td >{{ $product->sku }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

</div>
