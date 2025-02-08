<?php

namespace App\Livewire\Forms;

use App\Enums\PaymentMethod;
use App\Enums\Status;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Validate;
use Livewire\Form;

class OrderForm extends Form
{
    #[Validate('required')]
    public $customer_id;
    #[Validate('required')]
    public $invoice_number;
    #[Validate('required|numeric')]
    public $total_price;

    #[Validate(['required', (new Enum(Status::class))])]
    public $status;
    #[Validate(['required', (new Enum(PaymentMethod::class))])]
    public $payment_method;

    public function save()
    {
//        $this->validate();

    }



}
