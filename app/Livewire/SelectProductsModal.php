<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
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

        $query = '';
        if (!empty($this->query)) {
            $query = $this->query;
        }

        return Product::search($query)
            ->query(fn(Builder $builder) => $builder->with(['category', 'stocks']))
            ->orderByDesc('created_at')
            ->paginate(15);
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

    public function render()
    {
        return view('livewire.select-products-modal');
    }
}
