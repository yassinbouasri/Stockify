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
    public ?\App\Models\Order $order = null;

    public array $productIdsList = [];
    public array $quantities = [];

    public array $maxQuantities = [];

    protected $listeners = [
        'selectedProducts'
    ];
    protected $rules = [
        'quantities' => 'array',
    ];


    public function mount(Collection $products, \App\Models\Order $order)
    {
        $this->products = $products;
        $this->order = $order;


        foreach ($products->filter() as $product) {
            $this->quantities[$product->id] = $product->pivot->quantity ?? 1;
            foreach ($product->stocks as $stock) {
                $this->maxQuantities[$product->id] = $stock->quantity;
            }
        }
    }


    public function selectedProducts(array $products)
    {
        $this->productIdsList = $products;
        $this->resetPage();
    }

    #[Computed(cache: false)]
    public function productList()
    {
        if (empty($this->productIdsList)) {
            $this->productIdsList = $this->products->pluck('id')->toArray();
        }

        $products = Product::whereIn('id', $this->productIdsList)
                           ->with(['category', 'stocks'])
                           ->orderByDesc('created_at')
                           ->paginate(10);

        $this->setDefaultQuantity($products);
        $this->setMaxQuantity($products);

        return $products;
    }

    private function setDefaultQuantity($products): void
    {
        $this->quantities = array_map('intval', array_intersect_key($this->quantities, array_flip($this->productIdsList)));

        foreach ($products as $product) {
            if (!isset($this->quantities[$product->id])) {
                $this->quantities[$product->id] = 1;
            }

        }
        session()->put('quantities', $this->quantities);
    }
    private function setMaxQuantity($products)
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
