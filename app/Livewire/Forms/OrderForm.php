<?php

namespace App\Livewire\Forms;

use App\Actions\Stockify\AddProductsToOrder;
use App\Actions\Stockify\DecrementProductStockQuantity;
use App\Actions\Stockify\OrderProductAttacher;
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


    public function save($productId, array $quantities, OrderProductAttacher $orderAttach)
    {
        $this->validate();

        DB::transaction(function () use ($productId, $quantities, $orderAttach) {

            $products = Product::find($productId);

            $this->setTotalPrice($products,$quantities);


            $order = Order::firstOrCreate($this->only(['customer_id', 'invoice_number', 'total_price', 'status', 'payment_method']));

            $orderAttach->attachProduct($products, $order, $quantities);

        });
    }

    /**
     * @param $products
     * @return void
     */
    private function setTotalPrice($products, $quantities): void
    {
        foreach ($products as $product) {

            $this->total_price += $product->price->multiply($quantities[$product->id])->getAmount();
        }
    }

}
