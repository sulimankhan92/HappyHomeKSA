<?php

namespace App\Livewire\OrderItems;

use App\Livewire\Forms\OrderItemForm;
use App\Models\OrderItem;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public OrderItemForm $form;

    public function mount(OrderItem $orderItem)
    {
        $this->form->setOrderItemModel($orderItem);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('order-items.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.order-item.create');
    }
}
