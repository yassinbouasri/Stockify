<?php

namespace App\Livewire;

use App\Models\Order;

class PrintOrderDetails extends Printable
{
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
        return $this->order->products;
    }

    public function render()
    {
        return view('livewire.print-order-details');
    }
}
