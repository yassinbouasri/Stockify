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
        </tr>
        </thead>
        <tbody class="text-gray-700 dark:text-gray-400">
        @foreach($this->orders as $order)
            <tbody x-data="{ expanded: false }">
            <tr class="border-b dark:border-gray-600 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
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
