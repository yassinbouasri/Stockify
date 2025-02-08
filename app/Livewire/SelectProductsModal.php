<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class SelectProductsModal extends Component
{
    use WithPagination;
    public bool $show = false;
    public string $query = '';

    public Product $product;

    public function updatedQuery()
    {
        $this->searchedProducts();
    }

    #[Computed]
    public function searchedProducts()
    {
        $query = '';
        if (!empty($this->query)) {
            $query = $this->query;
        }

        return Product::search($query)
            ->query(fn(Builder $builder) => $builder->with(['category', 'stocks']))
            ->paginate(10);
    }

    public function selectedProduct(int $id)
    {

        $this->product = Product::find($id);
        $this->query = $this->product->name;
    }


    public function openModal()
    {
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.select-products-modal');
    }
}
