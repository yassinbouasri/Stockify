<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{

    public $id;
    public $name = '';
    public $sku = '';
    public $description = '';
    public $price;
    public int $category_id;
    public $photo;

    public $image = '';


    public Product $product;

    public function rules()
    {
        return [
            'name' => 'required',
            'sku' => 'required',
//            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
//            'image' => 'image|max:1024'
        ];
    }

    public function setProducts(Product $product)
    {
        $this->id = $product->id;
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->description = $product->description;
        $this->category_id = $product->category_id;
        $this->price = $product->price;
        $this->image = $product->image;

        $this->product = $product;

    }
    public function update()
    {
        $this->validate();
        if ($this->photo) {
            $this->image = $this->photo->store('products', 'public');
        }

        $this->product->update(
            $this->only(['name', 'sku', 'description', 'price', 'category_id', 'image'])
        );
    }
    public function store()
    {
        $this->validate();

        if ($this->photo) {
            $this->image = $this->photo->store('products', 'public');
        }

        Product::create($this->only('name', 'sku', 'description', 'price', 'category_id', 'image'));
    }
}
