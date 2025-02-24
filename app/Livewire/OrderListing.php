<?php

namespace App\Livewire;

use App\Actions\Stockify\OrderProductService;
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
        $query = trim($this->query ?? '');

        $baseQuery = Order::select()
                            ->with(['products', 'customer'])
                            ->orderByDesc('created_at');
        if (!empty($query)) {
            return Order::search($this->query)
                        ->query(fn(Builder $builder) => $builder->with(['products', 'customer'])->mergeConstraintsFrom($baseQuery))
                        ->paginate(20);
        }
        return $baseQuery->paginate(20);
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
