<?php

namespace App\Livewire;

use App\Actions\Stockify\UpdateStock;
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

    public function mount(Product $product)
    {
        $this->form->setProducts($product);
    }
    #[Computed]
    public function categories()
    {
        return Category::all();
    }
    public function save(UpdateStock $stock)
    {
        $this->form->update($stock);
    }

    public function render()
    {
        return view('livewire.update-product');
    }
}
