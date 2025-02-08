<?php

namespace App\Livewire;

use App\Enums\PaymentMethod;
use App\Enums\Status;
use App\Livewire\Forms\OrderForm;
use App\Models\Customer;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Order extends Component
{
    public $paymentMethod;
    public OrderForm $form;
    public array $products = [];


    public ?Customer $customer = null;
    protected $listeners = [
        'selectedCustomer',
        'selectedProducts',
    ];

    public function selectedCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function mount()
    {
        $this->paymentMethod = PaymentMethod::cases();
    }
    #[Computed]
    public function selectedProducts(array $products)
    {
        $this->products = $products;
    }

    public function store()
    {
        dd($this->products,$this->customer);
        $this->form->save();
    }
    public function render()
    {
        return view('livewire.orders',[
            'ordersStatus' => Status::cases()
        ]);
    }
}
