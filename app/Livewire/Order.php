<?php

namespace App\Livewire;

use App\Enums\PaymentMethod;
use App\Enums\Status;
use App\Livewire\Forms\OrderForm;
use App\Models\Customer;
use App\Models\Product;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Order extends Component
{
    use InteractsWithBanner;
    public $paymentMethod;
    public OrderForm $form;


    public ?Customer $customer = null;
    protected $listeners = [
        'selectedCustomer',
        'selectedProducts',
    ];

    public array $products = [];

    public function selectedProducts(array $products)
    {
        $this->products = $products;
    }

    public function selectedCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function mount()
    {
        $this->paymentMethod = PaymentMethod::cases();
    }

    public function store()
    {
        $this->form->save($this->products);
        $this->banner('Order placed');
    }
    public function render()
    {
        return view('livewire.orders',[
            'ordersStatus' => Status::cases()
        ]);
    }
}
