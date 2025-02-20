<?php

namespace App\Livewire;

use AllowDynamicProperties;
use App\Actions\Stockify\OrderProductAttacher;
use App\Enums\PaymentMethod;
use App\Enums\Status;
use App\Livewire\Forms\OrderForm;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

#[AllowDynamicProperties]
class UpdateOrder extends Component
{
    public OrderForm $form;
    public Customer $customer;
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
        $this->form->setOrder($order);
        $this->paymentMethod = PaymentMethod::cases();
        $this->customer = $order->customer;
        $this->products = $order->products;
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
