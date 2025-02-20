<?php

namespace App\Livewire;

use AllowDynamicProperties;
use App\Actions\Stockify\OrderProductAttacher;
use App\Enums\PaymentMethod;
use App\Enums\Status;
use App\Livewire\Forms\OrderForm;
use App\Models\Customer;
use App\Models\Product;
use Livewire\Component;

#[AllowDynamicProperties]
class UpdateOrder extends Component
{
    public OrderForm $form;
    public  $customer = null;
    public array $products = [];
    public ?array $quantities = [];
    public array $maxQuantities = [];
//    public \App\Models\Order $order;


    protected $listeners = [
        'selectedCustomer', 'selectedProducts', 'maxQuantities',
    ];

    public function selectedProducts(array $products)
    {
        $this->products = $products;
    }

//    public function selectedCustomer(Customer $customer)
//    {
//        $this->customer = $customer;
//    }

    public function maxQuantities(array $quantities)
    {
        $this->maxQuantities = $quantities;
    }
    public function mount(\App\Models\Order $order)
    {
        $this->form->setOrder($order);
        $this->paymentMethod = PaymentMethod::cases();
        $this->customer = $order->customer;

    }

    public function editOrder(OrderProductAttacher $orderAttach)
    {
        $this->quantities = $this->getMaxAndDefaultQuantity($this->quantities);
        $this->maxQuantities = $this->getMaxAndDefaultQuantity(session()->get('maxQuantities'));

        $this->form->update($this->quantities, $this->maxQuantities, $orderAttach);

        $this->banner('Order edited');
    }
    public function render()
    {
        return view('livewire.update-order', [
            'ordersStatus' => Status::cases()
        ]);
    }
}
