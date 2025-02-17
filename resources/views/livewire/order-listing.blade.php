<div class="dark:bg-gray-800 bg-white">
    <x-slot:header>Orders List</x-slot:header>
    <div class="flex justify-between mt-2 mb-4">
        <a wire:navigate href="{{ route('create-order') }}"
           class="px-3 mt-1 ml-6 inline-flex items-center py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
            New Order
        </a>
        <x-input wire:model.live.debounce="query" type="search" placeholder="Search..."/>
    </div>

    <table class="table-auto w-full max-w-6xl mx-auto my-3">
        <thead class="bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-400 shadow text-left"
               style="text-align: left !important;">
        <tr class="">
            <th>Customer</th>
            <th>Invoice Id</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Payment Method</th>
            <th>Created At</th>
            <th></th>
        </tr>
        </thead>
        <tbody class="text-gray-700 dark:text-gray-400">
        @foreach($this->orders as $order)
            <tr class="border-b dark:border-gray-600 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                <td>{{ $order->customer->name }}</td>
                <td>{{ $order->invoice_number }}</td>
                <td>{{ $order->total_price }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->payment_method }}</td>
                <td>{{ $order->created_at->toFormattedDateString() }}</td>


                <td class="flex gap-1">
                        {{--                    <button wire:click="$dispatch('preview-image', { url: '{{ $product->image }}' })">--}}

                    </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <livewire:image-preview/>

    <div class="mx-3 my-3 mt-4 mb-4">
        {{ $this->orders->links() }}
    </div>

</div>
