<?php

namespace App\Livewire\Forms;

use App\Actions\Stockify\UpdateStock;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Support\Facades\DB;
use Livewire\Form;

class ProductForm extends Form
{

    public ?int $id = null;
    public string $name = '';
    public string $sku = '';
    public string $description = '';
    public float $price = 0.0;
    public int $category_id;
    public $photo = null;
    public ?string $image = null;
    public int $quantity = 0;

    public ?Product $product = null;
    public ?Stock $stock = null;


    public function rules()
    {
        return [
                'name' => 'required',
                'sku' => 'required',
                'description' => 'max:500',
                'price' => 'required',
                'category_id' => 'required',
                'image' => 'nullable|max:1024',
            ];
    }

    public function setProducts(Product $product)
    {
        $this->product = $product;
        $this->id = $product->id;
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->category_id = $product->category_id;
        $this->image = $product->image;

        foreach ($product->stocks as $stock) {
                $this->stock = $stock;
                $this->quantity = $stock->quantity;
        }
    }

    public function update(UpdateStock $stockUpdate)
    {
        $this->validate();
        if ($this->photo) {
            $this->image = $this->photo->store('products', 'public');
        }
        DB::transaction(function () use ($stockUpdate) {

            $this->product->update($this->only(['name', 'sku', 'description', 'price', 'category_id', 'image']));

            $stockUpdate->saveStock($this->stock, $this->quantity, $this->product);
        });

    }

    public function store(UpdateStock $stockUpdate)
    {
        $this->validate();

        if ($this->photo) {
            $this->image = $this->photo->store('products', 'public');
        }


        DB::transaction(function () use ($stockUpdate) {

            $product = Product::create($this->only('name', 'sku', 'description', 'price', 'category_id', 'image'));

            $stockUpdate->saveStock($this->stock, $this->quantity, $product);
        });


    }


}
