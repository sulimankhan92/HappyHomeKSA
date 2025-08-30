<?php

namespace App\Livewire\Orders;

use App\Models\Order;
//use App\Models\OrderItem;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

//    protected $paginationTheme = 'custom';
    public $search = '';

    #[Layout('layouts.app')]
    public function render(): View
    {
//        $orders = Order::paginate();
//        return view('livewire.order.index', compact('orders'))
//            ->with('i', $this->getPage() * $orders->perPage());

        $orders = Order::search($this->search)->paginate();

        return view('livewire.order.index', compact('orders'))
            ->with('i', $this->getPage() * $orders->perPage());
    }

    public function searchOrders($term)
    {
        $this->search = $term;
    }

    public function delete(Order $order)
    {
        $order->delete();

        return $this->redirectRoute('orders.index', navigate: true);
    }
}
