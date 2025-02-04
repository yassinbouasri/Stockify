<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchCustomer extends Component
{
    public string $search = "";
    public bool $show = true;

    public function getEmail(int $id)
    {
        $this->show = false;
        foreach ($this->customers($id) as $customer) {
                $this->search = $customer->email;
        }
    }

    #[Computed]
    public function customers(?int $id = null)
    {

        if ($this->search == '') {
            return [];
        }
        $customers = Customer::search($this->search)->options(['name', 'email']);
        if ($id != null) {

            $customers->where('id', $id);
        }
        return $customers->get();
    }

    public function render()
    {
        return view('livewire.search-customer');
    }
}
