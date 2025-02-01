<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProduct extends Component
{
    use WithFileUploads;

    public ProductForm $form;

    public function mount(Product $product, Stock $stock)
    {
        $this->form->setProducts($product, $stock);
    }
    #[Computed]
    public function categories()
    {
        return Category::all();
    }
    public function save()
    {
        $this->form->update();
    }

    public function render()
    {
        return view('livewire.update-product');
    }
}
