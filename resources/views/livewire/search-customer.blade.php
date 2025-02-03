<div>
    <div class=" mx-4 my-4">
        <x-label class="p-1">Customer Email:</x-label>
        <x-input type="search" class="w-1/2 p-1"
                 wire:model.live.debounce="search"
                 autofocus
        />

    </div>
    @if($this->customers)
    <div class="mt-4 p-7 absolute border border-indigo-700 rounded-lg dark:bg-gray-700 max-h-96 overflow-y-auto">

            @foreach($this->customers as $customer)
                {{ $customer->name }} <br/>
            @endforeach

    </div>
    @endif
</div>
