<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductCart extends Component
{
    protected $listeners = [
        'selectedProducts',
    ];

    public array $products = [];

    public function selectedProducts(array $products)
    {
        $this->products = $products;
    }

    public function getProductListProperty()
    {
        return Product::find(array_keys($this->products));
    }
    public function render()
    {
        return view('livewire.product-cart');
    }
}
