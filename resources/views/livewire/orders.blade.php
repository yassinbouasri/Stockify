@php use App\Enums\Status; @endphp
@php use App\Enums\PaymentMethod; @endphp
<div class="flex" wire:click="$dispatch('search:clear-results')">
    <x-slot:header>Orders Management</x-slot:header>



    <div class="w-2/5 ">
        <div class=" mx-4 my-4">

            <livewire:select-products-modal/>

        </div>
        <form wire:submit="store" class="mt-4 mb-4" >

            <livewire:search-customer/>


            <div class=" mx-4 my-4">
                <x-label class="p-1">Invoice Number:</x-label>
                <x-input type="text" class="w-full p-1"
                         wire:model="form.invoice_number"
                         placeholder="9025557-2170968-56960547"
                />

            </div>

            <div class=" mx-4 my-4">
                <x-label class="p-1">Status:</x-label>
                <select
                    wire:model="form.status"
                    class="  border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full p-1">

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
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full p-1">
                    <option>Select A Payment Method...</option>

                    @foreach($this->paymentMethod as $payment)
                        <option
                            value="{{ PaymentMethod::from($payment->value) }}"> {{ ucfirst($payment->value) }}</option>
                    @endforeach
                </select>

            </div>
            <div class="mx-4 my-4">
                <x-validation-errors/>
            </div>

            <div class=" mx-4 my-4">

                <x-button>Create Order</x-button>
            </div>
        </form>
    </div>
    <div class="w-2/6  text-white mx-40 my-20">
        <livewire:product-cart wire:model.live.defer="quantities" />
    </div>
</div>
