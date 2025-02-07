@php use App\Enums\Status; @endphp
@php use App\Enums\PaymentMethod; @endphp
<div>
    <x-slot:header>Orders Management</x-slot:header>

    <form wire:submit="store" class="mt-4 mb-4" wire:click="$dispatch('search:clear-results')">

        <div class=" mx-4 my-4">

            <livewire:select-products-modal/>

        </div>

        <livewire:search-customer/>


        <div class=" mx-4 my-4">
            <x-label class="p-1">Invoice Number:</x-label>
            <x-input type="text" class="w-1/2 p-1"
                     wire:model="form.invoice_number"
                     placeholder="9025557-2170968-56960547"
            />

        </div>

        <div class=" mx-4 my-4">
            <x-label class="p-1">Total Price:</x-label>
            <x-input type="number" class="w-1/2 p-1"
                     wire:model.live="form.total_price"
                     placeholder="Sub Total"
            />

        </div>
        <div class=" mx-4 my-4">
            <x-label class="p-1">Status:</x-label>
            <select
                wire:model="form.status"
                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-1/2 p-1">

                <option>Select A Status...</option>
                @foreach($ordersStatus as $status)
                    <option
                        value="{{ Status::tryFrom($status->value) }}"> {{ ucfirst($status->value) }}</option>
                @endforeach
            </select>

        </div>
        <div class=" mx-4 my-4">
            <x-label class="p-1">Payment Method:</x-label>
            <select
                wire:model="form.payment_method"
                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-1/2 p-1">
                <option>Select A Payment Method...</option>

                @foreach($this->paymentMethod as $payment)
                    <option
                        value="{{ PaymentMethod::from($payment->value) }}"> {{ ucfirst($payment->value) }}</option>
                @endforeach
            </select>

        </div>
        <div class="mx-4 my-4">
            <x-validation-errors></x-validation-errors>
        </div>

        <div class=" mx-4 my-4">
            <x-button>Create Order</x-button>
        </div>
    </form>
</div>
