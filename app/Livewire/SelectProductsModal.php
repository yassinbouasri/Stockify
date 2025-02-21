<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class SelectProductsModal extends Component
{
    use WithPagination;
    public bool $show = false;
    public string $query = '';
    public bool $selected = false;


    public array $selectedProducts = [];

    public Product $product;


    public function updatedQuery()
    {
        $this->searchedProducts();
        $this->resetPage();
    }

    #[Computed]
    public function searchedProducts()
    {
        $query = $this->query ?? '';

        $baseQuery = Product::query()->whereHas('stocks', function (Builder $query) {
            $query->where('stocks.quantity', '>', 0);
        }
        )->with(['stocks', 'category']);

        if (!empty($query)) {
             return Product::search($query)
                               ->query(fn(Builder $builder) => $builder->mergeConstraintsFrom($baseQuery))
                               ->paginate(20);
        }
        return $baseQuery->paginate(20);

    }
    public function toggleProduct(int $product)
    {
        $this->selectedProducts[$product] =  !($this->selectedProducts[$product] ?? false);
        $this->dispatch('selectedProducts', array_keys(array_filter($this->selectedProducts)));
    }

    #[Computed]
    public function selectedCount()
    {
        return count(array_keys(array_filter($this->selectedProducts))) ?? 0;
    }


    public function openModal()
    {
        $this->show = true;
        $this->resetPage();
    }

    public function previewImage($imageUrl)
    {
        $this->dispatch('preview-image', url: $imageUrl);
    }

    public function render()
    {
        return view('livewire.select-products-modal');
    }
}
