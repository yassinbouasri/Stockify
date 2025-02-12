<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCart extends Component
{
    use WithPagination;
    protected $listeners = [
        'selectedProducts',
    ];

    public array $products = [];

    #[Modelable]
    public array $quantities = [];


    public function mount()
    {
        foreach ($this->productList as $product) {

        }
        $this->quantities[199] = 1;
    }

    public function selectedProducts(array $products)
    {
        $this->products = $products;
        $this->resetPage();
    }

    #[Computed]
    public function productList()
    {
        if (!$this->products) {
            return [];
        }
        return Product::whereIn('id', $this->products)->with(['category','stocks'])->paginate(10);
    }
    public function render()
    {
        return view('livewire.product-cart');
    }
}
