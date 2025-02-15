<?php

namespace App\Livewire;


use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;
use Typesense\Collection;

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
        return $this->order->products()->paginate(10);
    }

    public function prepareForPrint()
    {
        return redirect()->route('print-details', ['order' => $this->order->id]);

    }

    public function render()
    {
        return view('livewire.order-details');
    }
}
