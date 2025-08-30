<?php

namespace App\Livewire\OrderItemsReturns;

use App\Models\OrderItemsReturn;
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
        $orderItemsReturns = OrderItemsReturn::paginate();

        return view('livewire.order-items-return.index', compact('orderItemsReturns'))
            ->with('i', $this->getPage() * $orderItemsReturns->perPage());
    }

    public function delete(OrderItemsReturn $orderItemsReturn)
    {
        $orderItemsReturn->delete();

        return $this->redirectRoute('order-items-returns.index', navigate: true);
    }
}
