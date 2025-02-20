<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCart extends Component
{
    use WithPagination;

    public ?Collection $products = null;

    public array $productList = [];
    #[Modelable]
    public array $quantities = [];

    public array $maxQuantities = [];

    protected $listeners = [
        'selectedProducts'
    ];

    public function mount(Collection $products)
    {
        $this->products = $products;
    }

    public function selectedProducts(array $products)
    {
        $this->productList = $products;
        $this->resetPage();
    }

    #[Computed(cache: false)]
    public function productList()
    {
        if (!$this->productList) {
            return [];
        }

        $products = Product::whereIn('id', $this->productList)
                           ->with(['category', 'stocks'])
                           ->orderByDesc('created_at')
                           ->paginate(10);

        $this->setDefaultQuantity($products);
        $this->setMaxQuantity($products);

        return $products ?? $this->products;
    }

    public function setDefaultQuantity($products): void
    {
        $this->quantities = array_map('intval', array_intersect_key($this->quantities, array_flip($this->productList)));

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
