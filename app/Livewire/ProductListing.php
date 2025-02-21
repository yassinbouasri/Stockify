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

    #[Computed(cache: false)]
    public function searchedProducts()
    {
        $query = trim($this->query ?? '');

        $baseQuery = Product::select()
                            ->with(['stocks', 'category'])
                            ->orderByDesc('created_at');

        if (!empty($query)){
            return Product::search($query)
                               ->query(fn(Builder $builder) => $builder->with(['stocks', 'category'])->mergeConstraintsFrom($baseQuery))
                               ->paginate(20);
        }
        return $baseQuery->paginate(20);

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
