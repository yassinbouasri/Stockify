<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SelectProductsModal extends Component
{
    public $show = false;
    public $searchProduct = '';

    public Product $product;

    #[Computed]
    public function searchedProducts()
    {
        if(empty($this->search)){
            return collect();
        }

        return Product::search($this->search)->options(['name', 'sku'])->get();
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
