<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class SearchCustomer extends Component
{
    public string $search = "";
    public bool $show = false;


    public function updatedSearch()
    {
        $this->customers();
    }

    #[On('search:clear-results')]
    public function clear()
    {
        $this->show = false;
    }

    public function selectCustomer(int $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $this->search = $customer->email;
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
