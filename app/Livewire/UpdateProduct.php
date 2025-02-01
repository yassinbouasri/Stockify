<?php

namespace App\Livewire;

use App\Actions\Stockify\UpdateStock;
use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Product;
use App\Models\Stock;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProduct extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

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
        $this->banner('Product updated successfully.');
    }

    public function render()
    {
        return view('livewire.update-product');
    }
}
