<?php

namespace App\Livewire\OrderItemsCanceleds;

use App\Models\Order;
use App\Models\OrderItemsCanceled;
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
//        $orderItemsCanceleds = OrderItemsCanceled::paginate();
        $orderItemsCanceleds = Order::where('status','8')->paginate();
        return view('livewire.order-items-canceled.index', compact('orderItemsCanceleds'))
            ->with('i', $this->getPage() * $orderItemsCanceleds->perPage());
    }

    public function delete(OrderItemsCanceled $orderItemsCanceled)
    {
        $orderItemsCanceled->delete();

        return $this->redirectRoute('order-items-canceleds.index', navigate: true);
    }
}
