<?php

namespace App\Livewire;

use App\Enums\PaymentMethod;
use App\Enums\Status;
use App\Livewire\Forms\OrderForm;
use Livewire\Component;

class Order extends Component
{
    public $paymentMethod;
    public OrderForm $form;



    public function mount()
    {
        $this->paymentMethod = PaymentMethod::cases();
    }

    public function store()
    {

        $this->form->save();

    }
    public function render()
    {
        return view('livewire.orders',[
            'ordersStatus' => Status::cases()
        ]);
    }
}
