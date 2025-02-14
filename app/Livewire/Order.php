<?php

namespace App\Livewire;

use App\Actions\Stockify\OrderProductAttacher;
use App\Enums\PaymentMethod;
use App\Enums\Status;
use App\Livewire\Forms\OrderForm;
use App\Models\Customer;
use Laravel\Jetstream\InteractsWithBanner;
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
        $this->quantities = array_map('intval', array_filter($this->quantities));

//        dd($this->quantities ?? 1);
        $this->validate([
            'quantities' => ['required', 'array', 'min:1'],
            'quantities.*' => ['required', 'integer', 'min:1'],
        ],[
            'quantities.required' => 'The quantity field is required.',
            'quantities.*.required' => 'The quantity field is required.',
            'quantities.*.integer' => 'The quantity must be a number.',
            'quantities.*.min' => 'The quantity must be higher or equal to 1.',
        ]);

        $order = $this->form->save($this->products, array_filter($this->quantities), $orderAttach);



        redirect()->route('order-details', ['order' => $order->id]);
        $this->banner('Order placed');
    }
    public function render()
    {
        return view('livewire.orders',[
            'ordersStatus' => Status::cases()
        ]);
    }
}
