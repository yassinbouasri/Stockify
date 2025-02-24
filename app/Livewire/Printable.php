<?php

namespace App\Livewire;

use App\Actions\Stockify\OrderProductService;
use App\Enums\PaymentMethod;
use App\Enums\Status;
use App\Livewire\Forms\OrderForm;
use App\Models\Customer;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.print')]
class Printable extends Component
{

}
