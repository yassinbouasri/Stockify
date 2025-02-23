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
    public array $products = [];
    public array $quantities = [];
    public array $maxQuantities = [];


    protected $listeners = [
        'selectedCustomer', 'selectedProducts', 'maxQuantities',

    ];

    public function selectedProducts(array $products)
    {
        $this->products = $products;
    }

    public function selectedCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function maxQuantities(array $quantities)
    {
        $this->maxQuantities = $quantities;
    }

    public function mount()
    {
        $this->paymentMethod = PaymentMethod::cases();
        $this->quantities[108] = 1;
        session()->forget('order.products');
    }


    public function store(OrderProductAttacher $orderAttach)
    {

        $this->quantities = $this->getMaxAndDefaultQuantity(session()->get('quantities'));
        $this->maxQuantities = $this->getMaxAndDefaultQuantity(session()->get('maxQuantities'));


        $this->validation();

        $order = $this->form->save($this->products, $this->quantities, $orderAttach, $this->maxQuantities);
        $this->banner('Order placed');
        redirect()->route('order-details', ['order' => $order->id]);

    }


    private function getMaxAndDefaultQuantity($value): array
    {
        return array_map('intval', array_intersect_key($value, array_flip($this->products)));
    }

    public function validation(): void
    {
        $this->validate([
                            'quantities' => [
                                'required', 'array'
                            ], 'quantities.*' => [
                'required', 'integer', 'min:1'
            ],
                        ], [
                            'quantities.required'   => 'The quantity field is required.',
                            'quantities.*.required' => 'The quantity field is required.',
                            'quantities.*.integer'  => 'The quantity must be a number.',
                            'quantities.*.min'      => 'The quantity must be higher or equal to 1.',
                        ]
        );
    }

    public function render()
    {
        return view('livewire.orders', [
                                         'ordersStatus' => Status::cases()
                                     ]
        );
    }
}
