<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class SearchCustomer extends Component
{
    public $search;

    public bool $show = false;

    public Customer $customer;


    public function updatedSearch()
    {
        $this->customers();
    }

    #[On('search:clear-results')]
    public function clear()
    {
        $this->show = false;
    }


    #[On('search:get-customer')]
    public function selectCustomer(int $id)
    {
        $this->customer = Customer::find($id);
        $this->dispatch('selectedCustomer', $this->customer);

        if ($this->customer) {
            $this->search = $this->customer->email;
            $this->show = false;
        }
    }


    #[Computed]
    public function customers()
    {
        if ($this->search == '' ) {
            return collect();
        }

        $this->show = true;
        return Customer::search($this->search)->options(['name', 'email'])->get();
    }

    public function render()
    {
        return view('livewire.search-customer');
    }
}
