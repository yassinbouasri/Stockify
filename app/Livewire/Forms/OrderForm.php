<?php

namespace App\Livewire\Forms;

use App\Actions\Stockify\AddProductsToOrder;
use App\Actions\Stockify\OrderProductService;
use App\Enums\PaymentMethod;
use App\Enums\Status;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Validate;
use Livewire\Form;

class OrderForm extends Form
{
    #[Locked]
    public $id = 0;
    public $customer_id;
    #[Validate('required')]
    public $invoice_number;

    public $total_price;

    #[Validate(['required', (new Enum(Status::class))])]
    public $status;
    #[Validate(['required', (new Enum(PaymentMethod::class))])]
    public $payment_method;

    public Order $order;

    public function setOrder(Order $order)
    {
        $this->order = $order;
        $this->invoice_number = $order->invoice_number;
        $this->total_price = $order->total_price->getAmount() / 100;
        $this->status = $order->status;
        $this->payment_method = $order->payment_method;
    }

    private function setTotalPrice($products, $quantities): void
    {
        foreach ($products as $product) {

            if (!isset($quantities[$product->id])) {
                $quantities[$product->id] = 1;
            }
            $this->total_price += $product->price->multiply($quantities[$product->id])->getAmount();
        }
    }
    public function save($productIds, Customer $customer, array $quantities, OrderProductService $orderProductService, array $maxQuantities)
    {
        $this->validate();

        $this->customer_id = $customer->id;

        return DB::transaction(function () use ($productIds, $customer,$quantities, $orderProductService,$maxQuantities) {

            $products = Product::find($productIds);

            $this->setTotalPrice($products,$quantities);


            $order = Order::firstOrCreate($this->only(['customer_id', 'invoice_number', 'total_price', 'status', 'payment_method']));

            $orderProductService->attachProduct($products, $order, $quantities, $maxQuantities);

            return $order;
        });

    }


    public function update($productIds,Customer $customer ,array $quantities, array $maxQuantities, OrderProductService $orderProductService)
    {
        $this->validate();

        $this->customer_id = $customer->id;

        return DB::transaction(function () use($productIds, $customer, $quantities, $orderProductService, $maxQuantities) {
            $products = Product::find($productIds);

            $this->setTotalPrice($products,$quantities);

            $this->order->update($this->only(['customer_id', 'invoice_number', 'total_price', 'status', 'payment_method']));

            $orderProductService->updateProduct($products, $this->order, $quantities, $maxQuantities);
            return $this->order->fresh(['products']);
        });

    }

}
