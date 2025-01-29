<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ProductListings extends Component
{
    use WithPagination;

    #[Computed]
    public function products()
    {
        return Product::paginate(10);
    }
    public function render()
    {
        return view('livewire.product-listings');
    }
}
