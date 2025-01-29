<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ProductListings extends Component
{
    use WithPagination;

    public string $search = '';

    #[Computed]
    public function products()
    {
        return Product::query()
            ->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('description', 'like', '%'.$this->search.'%')
            ->orWhere("sku", "like", '%'.$this->search.'%')
            ->paginate(20);
    }

    public function render()
    {
        return view('livewire.product-listings');
    }
}
