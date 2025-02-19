<?php

namespace App\Livewire;

use App\Actions\Stockify\OrderProductAttacher;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class OrderListing extends Component
{
    use WithPagination;

    public string $query = '';
    #[Computed]
    public function orders()
    {
        if (empty($this->query)) {
            return Order::with(['products', 'customer'])->paginate(20);
        }

        return Order::search($this->query)
                         ->query(fn(Builder $builder) => $builder->with(['products', 'customer']))
                         ->paginate(15);
    }

    public function updatedQuery()
    {
        $this->orders();
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.order-listing');
    }
}
