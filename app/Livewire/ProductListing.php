<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductListing extends Component
{
    use WithPagination;

    public string $query = '';

    public function updatedQuery()
    {
        $this->searchedProducts();
        $this->resetPage();
    }

    #[Computed]
    public function searchedProducts()
    {
        if (empty($this->query)) {
            return Product::with(['category', 'stocks'])->paginate(20);
        }
        return Product::search($this->query)
                      ->query(fn(Builder $builder) => $builder->with(['category', 'stocks']))
                      ->orderByDesc('created_at')
                      ->paginate(20);
    }



    public function previewImage($imageUrl)
    {
        $this->dispatch('preview-image', url: $imageUrl);
    }

    public function delete(Product $product)
    {
        $product->delete();
        $this->resetPage();
    }


    public function render()
    {
        return view('livewire.product-listings');
    }
}
