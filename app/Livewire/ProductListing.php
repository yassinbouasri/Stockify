<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProductListing extends Component
{
    use WithPagination;

    #[Url(history: true, as: 'q')]
    public string $search = '';

    #[Computed]
    public function products()
    {
        $query = '';
        if (!empty($this->query)) {
            $query = $this->query;
        }
        return Product::search($query)
                      ->query(fn(Builder $builder) => $builder->with(['category', 'stocks']))
                      ->orderByDesc('created_at')
                      ->paginate(15);
    }

    public function updatedSearch()
    {
        $this->products();
        $this->resetPage();
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
