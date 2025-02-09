<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Stock;
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
        $query = Product::query()->with(['category','stocks']);
        if ($this->search) {
            $query->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('description', 'like', '%'.$this->search.'%')
                ->orWhere("sku", "like", '%'.$this->search.'%')
                ->orWhereHas('category', function ($query) {
                    $query->where('name', 'like', '%'.$this->search.'%');
                });
            $this->resetPage();
        }
        return $query->orderByDesc('created_at')->paginate(20);
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
