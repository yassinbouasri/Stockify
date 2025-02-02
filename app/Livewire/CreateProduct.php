<?php

namespace App\Livewire;

use App\Actions\Stockify\UpdateStock;
use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $title = 'Create Product';

    public ProductForm $form;

    #[Computed]
    public function categories()
    {
        return Category::all();
    }
    public function save(UpdateStock $stock)
    {

        $this->form->store($stock);
        $this->banner('Product created successfully');
        redirect()->route('products');

    }

    public function render()
    {
        return view('livewire.create-product');
    }
}
