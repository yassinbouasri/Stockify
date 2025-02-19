<div class="dark:bg-gray-800 bg-white dark:text-gray-400">
    <x-slot:header>Orders List</x-slot:header>
    <div class="flex justify-between mt-2 mb-4">
        <a wire:navigate href="{{ route('create-order') }}"
           class="px-3 mt-1 ml-6 inline-flex items-center py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150">
            New Order
        </a>
        <x-input wire:model.live.debounce="query" type="search" placeholder="Search..."/>
    </div>



    <table class="table-auto w-full max-w-6xl mx-auto my-3">
        <thead class="bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-400 shadow text-left">
        <tr>
            <th class="w-8"></th>
            <th class="p-3">C. Name</th>
            <th class="p-3">Invoice Id</th>
            <th class="p-3">Total Price</th>
            <th class="p-3">Status</th>
            <th class="p-3">P. Method</th>
            <th class="p-3">Created At</th>
            <th class="p-3"></th>
        </tr>
        </thead>
        <tbody class="text-gray-700 dark:text-gray-400">
        @foreach($this->orders as $order)
            <tbody x-data="{ expanded: false }">
            <tr  class="border-b dark:border-gray-600 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                <td class="p-3">
                    <button
                            @click="expanded = !expanded"
                            class="text-indigo-600 hover:text-indigo-900 focus:outline-none"
                    >
                        <span x-text="expanded ? '−' : '+'"></span>
                    </button>
                </td>
                <td class="p-3">{{ $order->customer->name }}</td>
                <td class="p-3">{{ $order->invoice_number }}</td>
                <td class="p-3">{{ $order->total_price }}</td>
                <td class="p-3">{{ $order->status }}</td>
                <td class="p-3">{{ $order->payment_method }}</td>
                <td class="p-3">{{ $order->created_at->toFormattedDateString() }}</td>
                <td class="p-3"><a href="{{ route('update-order', $order) }}" wire:navigate>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                        </svg>

                    </a></td>
            </tr>

            <tr
                    x-show="expanded"
                    x-collapse
                    x-cloak
                    class="bg-gray-50 dark:bg-gray-700"
            >
                <td colspan="7" class="p-4">
                    <div class="grid grid-cols-2 gap-4 text-sm ml-6">
                        <div>
                            <h3 class="font-semibold mb-2">Customer Details</h3>
                            <p><span class="font-medium">Name:</span> {{ $order->customer->name }}</p>
                            <p><span class="font-medium">Email:</span> {{ $order->customer->email }}</p>
                            <p><span class="font-medium">Phone:</span> {{ $order->customer->phone }}</p>
                        </div>
                        <div>
                            <h3 class="font-semibold mb-2">Order Details</h3>
                            <p><span class="font-medium">Address:</span> {{ $order->customer->address }}</p>
                            <p><span class="font-medium">Order Date:</span> {{ $order->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
            @endforeach

    </table>



    <livewire:image-preview/>

    <div class="mx-3 my-3 mt-4 mb-4">
        {{ $this->orders->links() }}
    </div>

</div>
