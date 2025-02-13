<?php

namespace App\Livewire;

use App\Actions\Stockify\DecrementProductStockQuantity;
use App\Actions\Stockify\OrderProductAttacher;
use App\Enums\PaymentMethod;
use App\Enums\Status;
use App\Livewire\Forms\OrderForm;
use App\Models\Customer;
use App\Models\Product;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
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

    public ?array $quantities = [];


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


    public function store(OrderProductAttacher $orderAttach)
    {
        $this->quantities = array_filter($this->quantities);
        $this->validate([
            'quantities' => ['required'],
            'quantities.*' => ['required', 'min:1', 'integer'],
        ],[
            'quantities.*.required' => 'The quantity field is required.',
            'quantities.*.integer' => 'The quantity must be a number.',
            'quantities.*.min' => 'The quantity must be higher or equal to 1.',
        ]);
        $this->form->save($this->products, array_filter($this->quantities), $orderAttach);

        $this->banner('Order placed');
    }
    public function render()
    {
        return view('livewire.orders',[
            'ordersStatus' => Status::cases()
        ]);
    }
}
