<?php

namespace App\Livewire;

use App\Models\Product;
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
            return Product::search($query)->query(fn(Builder $builder) => $builder->mergeConstraintsFrom($baseQuery)
                )->paginate(20);
        }
        return $baseQuery->paginate(20);

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
        $this->toggleProduct(session: session()->get('order.products') ?? []);

    }

    public function toggleProduct(int $product = null, array $session = []): void
    {
        $sessionProducts = [];
        $session ??= session()->get('order.products');

        foreach ($session as $sessionProduct) {
            $sessionProducts[$sessionProduct] = true;
        }

        if ($product) {

            $this->selectedProducts[$product] = !($this->selectedProducts[$product] ?? false);
        }

        $this->selectedProducts += $sessionProducts;

        $this->dispatch('selectedProducts', array_keys(array_filter($this->selectedProducts)));
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
