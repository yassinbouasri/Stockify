<div>
    <div class=" mx-4 my-4">
        <x-label class="p-1">Customer Email:</x-label>
        <x-input type="search" class="w-full p-1"
                 wire:model.live="search"
                 autofocus
                 placeholder="Search customers..."
        />

    </div>
    @if($this->showSection)

        <x-search-results-section>
            @foreach($this->customers as $customer)
                <a

                    wire:click="selectCustomer({{ $customer->id }})"
                    href="#"
                    class="dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 font-bold">
                    {{ $customer->name . ' || ' . $customer->email . ' || ' . $customer->phone }}
                </a>
                <br/>
            @endforeach
        </x-search-results-section>
    @endif
</div>
