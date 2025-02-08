<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class SearchCustomer extends Component
{
    public $search;

    public bool $showSection = false;

    public Customer $customer;


    public function updatedSearch()
    {
        $this->customers();
    }

    #[On('search:clear-results')]
    public function clear()
    {
        $this->showSection = false;
    }


    #[On('search:get-customer')]
    public function selectCustomer(int $id)
    {
        $this->customer = Customer::find($id);
        $this->dispatch('selectedCustomer', $this->customer);

        if ($this->customer) {
            $this->search = $this->customer->email;
            $this->showSection = false;
        }
    }


    #[Computed]
    public function customers()
    {
        if ($this->search == '' ) {
            return collect();
        }

        $this->showSection = true;
        return Customer::search($this->search)->options(['name', 'email'])->get();
    }

    public function render()
    {
        return view('livewire.search-customer');
    }
}
