<?php

namespace App\Livewire\OrdersHistories;

use App\Models\OrdersHistory;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    public function render(): View
    {
        $ordersHistories = OrdersHistory::paginate();

        return view('livewire.orders-history.index', compact('ordersHistories'))
            ->with('i', $this->getPage() * $ordersHistories->perPage());
    }

    public function delete(OrdersHistory $ordersHistory)
    {
        $ordersHistory->delete();

        return $this->redirectRoute('orders-histories.index', navigate: true);
    }
}
