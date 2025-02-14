<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Validate;
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

    public function selectedProducts(array $products)
    {
        $this->products = $products;
        $this->resetPage();
    }

    #[Computed(cache: false)]
    public function productList()
    {
        if (!$this->products) {
            return [];
        }

        $products = Product::whereIn('id', $this->products)
            ->with(['category','stocks'])
            ->orderByDesc('created_at')
            ->paginate(10);

        foreach ($products as $product) {
            if (!isset($this->quantities[$product->id])) {
                $this->quantities[$product->id] = 1;
            }
        }

        return $products;
    }
    public function render()
    {
        return view('livewire.product-cart');
    }
}
