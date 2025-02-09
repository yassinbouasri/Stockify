<?php

namespace App\Livewire\Forms;

use App\Actions\Stockify\AddProductsToOrder;
use App\Enums\PaymentMethod;
use App\Enums\Status;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class OrderForm extends Form
{
    public $customer_id = 1;
    #[Validate('required')]
    public $invoice_number;
    #[Validate('required|numeric')]
    public $total_price;

    #[Validate(['required', (new Enum(Status::class))])]
    public $status;
    #[Validate(['required', (new Enum(PaymentMethod::class))])]
    public $payment_method;

    public int $quantity = 2;

    public function save($productId)
    {
//        $this->validate();

        DB::transaction(function () use ($productId) {


            $products = Product::find(array_keys($productId));
            $order = Order::firstOrCreate($this->only(['customer_id', 'invoice_number', 'total_price', 'status', 'payment_method']));


            foreach ($products as $product) {


                $totalAmount = ($product->price->getAmount() * $this->quantity);



                $order->products()->attach($product, ['quantity' => $this->quantity , 'total_amount' => $totalAmount]);

            }

        });


    }

}
