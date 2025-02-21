<?php

namespace App\Livewire;

use AllowDynamicProperties;
use App\Actions\Stockify\OrderProductAttacher;
use App\Enums\PaymentMethod;
use App\Enums\Status;
use App\Livewire\Forms\OrderForm;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class UpdateOrder extends Component
{
    use InteractsWithBanner;
    public OrderForm $form;
    public Customer $customer;
    public Order $order;
    public ?Collection $products = null;
    public array $productList = [];
    public ?array $quantities = [];
    public array $maxQuantities = [];




    protected $listeners = [
        'selectedCustomer', 'selectedProducts', 'maxQuantities',
    ];

    public function selectedProducts(array $products)
    {
        $this->productList = $products;
    }

    public function selectedCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function maxQuantities(array $quantities)
    {
        $this->maxQuantities = $quantities;
    }
    public function mount(\App\Models\Order $order)
    {
        $this->order = $order;
        $this->form->setOrder($order);
        $this->customer = $order->customer;
        $this->products = $order->products;
    }

    public function editOrder(OrderProductAttacher $orderAttach)
    {

        $this->quantities = session()->get('quantities');
        $this->maxQuantities = session()->get('maxQuantities');


        $this->form->update($this->quantities, $this->maxQuantities, $orderAttach);

        $this->banner('Order edited');
    }
    public function render()
    {
        return view('livewire.update-order', [
            'ordersStatus' => Status::cases(),
            'paymentMethods' => PaymentMethod::cases(),
        ]);
    }
}
