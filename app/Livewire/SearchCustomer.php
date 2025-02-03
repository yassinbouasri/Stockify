<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchCustomer extends Component
{
    public string $search = "";

    #[Computed]
    public function customers()
    {
        if ($this->search == '') {
            return [];
        }
        return Customer::search($this->search)->options(['name', 'email'])->get();

//        return Customer::where('email', 'like', $this->search.'%')
//            ->orWhere('phone', 'like', $this->search.'%')
//            ->orWhere('name', 'like', $this->search.'%')
//            ->orWhere('address', 'like', $this->search.'%')->get();
    }

    public function render()
    {
        return view('livewire.search-customer');
    }
}
