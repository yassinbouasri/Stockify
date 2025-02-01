<?php

namespace App\Livewire;

use App\Models\Stock;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StockQuantity extends Component
{
    use InteractsWithBanner;
    public Stock $stock;
    #[Validate('integer|min:0')]
    public int $quantity;

    public function mount(Stock $stock)
    {
        $this->stock = $stock;
        $this->quantity = $stock->quantity;
    }

    public function updateQuantity()
    {
        $this->validate();
        $this->stock->update(['quantity' => $this->quantity]);
        $this->banner('Stock Quantity Updated Successfully!');
    }
    public function render()
    {
        return view('livewire.stock-quantity');
    }
}
