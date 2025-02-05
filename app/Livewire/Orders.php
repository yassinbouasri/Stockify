<?php

namespace App\Livewire;

use App\Enums\PaymentMethod;
use App\Enums\Status;
use Livewire\Component;

class Orders extends Component
{
    public $paymentMethod;

    public function mount()
    {
        $this->paymentMethod = PaymentMethod::cases();
    }
    public function render()
    {
        return view('livewire.orders',[
            'ordersStatus' => Status::cases()
        ]);
    }
}
