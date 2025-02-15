<div>
    <script>
        window.onload = function() {
            // Show only printable content
            document.body.classList.add('print-visible');
            window.print();

            // Close window after print
            setTimeout(() => {
                window.close();
            }, 100);
        };
    </script>
    <div class="print-visible">
        <div class="dark:text-gray-300 ">
            <h2 class=" font-bold text-lg text-center mt-4">Order #{{ $order->id }} ({{ $order->status }})</h2>
            <div class=" font-thin text-xs text-center mt-0">{{ $order->created_at->toFormattedDateString() }}</div>

            <div class="flex justify-between mb-4 mt-6">
                <div>
                    <h3 class=" font-bold text-m">Invoice Details:</h3>

                    <div class="text-xs my-4 font-light ml-4">
                        <p> {{ $order->invoice_number }}</p>
                        <p> {{ $order->payment_method }}</p>
                        <p> {{ $order->status }}</p>
                        <p> {{ $order->total_price }}</p>

                    </div>

                </div>
                <div>
                    <h3 class=" font-bold text-m">Customer:</h3>
                    <div class="text-xs my-4 font-light ml-4">
                        <p>{{ $this->customer->name }}</p>
                        <p>{{ $this->customer->email }}</p>
                        <p>{{ $this->customer->address }}</p>
                        <p>{{ $this->customer->phone }}</p>

                    </div>
                </div>
            </div>

            <div class="border-t border-gray-300 my-4"></div>

            <h3 class="font-bold text-m my-4">Products:</h3>
            <div>

                <table class="text-gray-700 dark:text-gray-400 table-auto w-full max-w-6xl mx-auto my-3">
                    <thead class="bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-400 shadow text-left"
                           style="text-align: left !important;">
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                        <th>Image</th>
                    </tr>
                    </thead>
                    <tbody class="">
                    @foreach($this->products as $product)
                        <tr>

                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->pivot->quantity }}</td>
                            <td>{{ $product->pivot->total_amount }}</td>

                            <td class="p-1 size-1">
                                <img
                                    src="{{  $product->image ? url($product->image) : '#' }}"
                                    alt="Preview"
                                    class="mx-auto max-h-[70vh] object-contain"
                                >
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <div class="flex justify-end mx-8 my-4 text-xl">

                    <p><span class="font-bold">Total:</span> {{ $order->total_price }}</p>
                </div>

            </div>

        </div>
    </div>


</div>
