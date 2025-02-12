<?php

namespace App\Livewire\Forms;

use App\Actions\Stockify\AddProductsToOrder;
use App\Actions\Stockify\DecrementProductStockQuantity;
use App\Enums\PaymentMethod;
use App\Enums\Status;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Validate;
use Livewire\Form;

class OrderForm extends Form
{
    public $customer_id = 1;
    #[Validate('required')]
    public $invoice_number;

    public $total_price;

    #[Validate(['required', (new Enum(Status::class))])]
    public $status;
    #[Validate(['required', (new Enum(PaymentMethod::class))])]
    public $payment_method;



    public function save($productId, array $quantities)
    {
        $this->validate();

        DB::transaction(function () use ($productId, $quantities) {

            $products = Product::find($productId);

            $quantity = $this->productQuantity($products, $quantities);

            $this->setTotalPrice($products, $quantity);


            $order = Order::firstOrCreate($this->only(['customer_id', 'invoice_number', 'total_price', 'status', 'payment_method']));

            foreach ($products as $product) {

                $totalAmount = ($product->price->getAmount() * $quantity);
                $order->products()->attach(
                    $product,
                        [
                            'quantity' => $quantity,
                            'total_amount' => $totalAmount
                        ]);
            }

            (new DecrementProductStockQuantity())->decrement($products, $quantity);

        });


    }

    /**
     * @param $products
     * @return void
     */
    private function setTotalPrice($products, int $quantity): void
    {
        foreach ($products as $product) {

            $this->total_price += ($product->price->getAmount() * $quantity);
        }
    }

    private function productQuantity($products, array $quantities): int
    {
        $quantity = 0;
        foreach ($products as $product) {
            $quantity = $quantities[$product->id];
        }

        return $quantity;
    }



}
