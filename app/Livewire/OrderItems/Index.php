<?php

namespace App\Livewire\OrderItems;

use App\Models\OrderItem;
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
        $orderItems = OrderItem::paginate();

        return view('livewire.order-item.index', compact('orderItems'))
            ->with('i', $this->getPage() * $orderItems->perPage());
    }

    public function delete(OrderItem $orderItem)
    {
        $orderItem->delete();

        return $this->redirectRoute('order-items.index', navigate: true);
    }
}
