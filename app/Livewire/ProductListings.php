<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductListings extends Component
{
    use WithPagination;

    #[Url(history: true, as: 'q')]
    public string $search = '';


    #[Computed]
    public function products()
    {
        $query = Product::query();
        if ($this->search) {
            $query->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('description', 'like', '%'.$this->search.'%')
                ->orWhere("sku", "like", '%'.$this->search.'%')
                ->orWhereHas('category', function ($query) {
                    $query->where('name', 'like', '%'.$this->search.'%');
                })
            ;
            $this->resetPage();
        }
        return $query->paginate(20);
    }

    public function render()
    {
        return view('livewire.product-listings');
    }
}
