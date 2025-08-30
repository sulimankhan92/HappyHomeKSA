<?php

namespace App\Livewire\OrderItems;

use App\Livewire\Forms\OrderItemForm;
use App\Models\OrderItem;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public OrderItemForm $form;

    public function mount(OrderItem $orderItem)
    {
        $this->form->setOrderItemModel($orderItem);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.order-item.show', ['orderItem' => $this->form->orderItemModel]);
    }
}
