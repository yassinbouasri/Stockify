<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class SelectProductsModal extends Component
{
    public $show = false;
    public $search = '';

    public Product $product;

    public function selectProduct()
    {

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
