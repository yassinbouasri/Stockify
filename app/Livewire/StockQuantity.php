<?php

namespace App\Livewire;

use App\Actions\Stockify\UpdateStock;
use App\Models\Product;
use App\Models\Stock;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\Validate;
use Livewire\Component;

class StockQuantity extends Component
{
    use InteractsWithBanner;
    public Stock $stock;
    #[Validate('integer|min:0')]
    public int $quantity = 0;

    public function mount(Stock $stock)
    {
        $this->stock = $stock;
        $this->quantity = $stock->quantity;
    }

    public function updateQuantity(UpdateStock $updateStock, Product $product)
    {
        $this->validate();
        $updateStock->saveStock($this->stock, $this->quantity, $product);
        $this->banner('Stock Quantity Updated Successfully!');
    }
    public function render()
    {
        return view('livewire.stock-quantity');
    }
}
