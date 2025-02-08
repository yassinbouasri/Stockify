<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use PhpParser\Node\Expr\Array_;

class SelectProductsModal extends Component
{
    use WithPagination;
    public bool $show = false;
    public string $query = '';
    public bool $selected = false;

    public array $selectedProducts;

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
            ->orderByDesc('created_at')
            ->paginate();
    }

    public function toggleProduct(int $product)
    {
        $this->selectedProducts[$product] =  !($this->selectedProducts[$product] ?? false);
        $this->dispatch('selectedProducts', $this->selectedProducts);
    }

    public function selectProduct()
    {

        return $this->selectedProducts;
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
