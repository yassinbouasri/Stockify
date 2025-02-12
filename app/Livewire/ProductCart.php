<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Component;

class ProductCart extends Component
{
    protected $listeners = [
        'selectedProducts',
    ];

    public array $products = [];

    #[Modelable]
    public array $quantities = [];



    public function selectedProducts(array $products)
    {
        $this->products = $products;

    }

    #[Computed]
    public function productList()
    {
        return Product::find($this->products);
    }
    public function render()
    {
        return view('livewire.product-cart');
    }
}
