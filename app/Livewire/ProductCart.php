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

    public array $products = [];
    #[Modelable]
    public array $quantities = [];

    public array $maxQuantities = [];

    protected $listeners = [
        'selectedProducts'
    ];

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

        $products = Product::whereIn('id', $this->products)->with(['category', 'stocks'])->orderByDesc('created_at')->paginate(10);

        $this->setDefaultQuantity($products);
        $this->setMaxQuantity($products);

        return $products;
    }

    public function setDefaultQuantity($products): void
    {
        $this->quantities = array_map('intval', array_intersect_key($this->quantities, array_flip($this->products)));

        foreach ($products as $product) {
            if (!isset($this->quantities[$product->id])) {
                $this->quantities[$product->id] = 1;
            }

        }
    }
    public function setMaxQuantity($products)
    {
        foreach ($products as $product) {
            foreach ($product->stocks as $stock) {
                $this->maxQuantities[$product->id] = $stock->quantity;
            }
        }

        session()->put('maxQuantities', $this->maxQuantities);
    }

    public function render()
    {
        return view('livewire.product-cart');
    }

}
