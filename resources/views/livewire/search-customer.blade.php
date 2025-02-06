<div>
    <div class=" mx-4 my-4">
        <x-label class="p-1">Customer Email:</x-label>
        <x-input type="search" class="w-1/2 p-1"
                 wire:model.live="search"
                 autofocus
                 placeholder="Search customers..."
        />

    </div>

    @if($this->show)

        <div
            wire:transition.100ms
            class="ml-4 absolute border border-indigo-700 rounded-lg dark:bg-gray-700 max-h-60 overflow-y-auto shadow-lg bg-gray-100 bg-opacity-50 dark:bg-opacity-50"
        >

            @foreach($this->customers as $customer)
                <a

                    wire:click="selectCustomer({{ $customer->id }})"
                   href="#"
                   class="dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 font-bold">
                    {{ $customer->name . ' || ' . $customer->email . ' || ' . $customer->phone }}
                </a>
                <br/>
            @endforeach

        </div>
    @endif
</div>
