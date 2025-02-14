<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;

class OrderDetails extends Component
{
    use WithPagination;
    public Order $order;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function getCustomerProperty()
    {
        return $this->order->customer;
    }

    public function getProductsProperty()
    {
        return $this->order->products()->paginate(5);
    }

    public function render()
    {
        return view('livewire.order-details');
    }
}
