<div class="dark:bg-gray-800 bg-white">

        <div class="flex justify-between mx-2 my-2">
            <a wire:navigate href="{{ route('create-product') }}" class="px-3 mt-1 ml-6 inline-flex items-center py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150" >Add New</a>
            <x-input wire:model.live.debounce="search" type="search" placeholder="Search..."/>
        </div>

    <table class="table-auto w-full max-w-6xl mx-auto my-3">
        <thead class="bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-400 shadow ">
        <tr class="text-left">
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>SKU</th>
            <th>Description</th>
        </tr>
        </thead>
        <tbody class="text-gray-700 dark:text-gray-400">
        @foreach($this->products as $product)
            <tr class="border-b dark:border-gray-600 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ str($product->description)->words(3) }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div class="mx-3 my-3">
        {{ $this->products->links() }}
    </div>

</div>
