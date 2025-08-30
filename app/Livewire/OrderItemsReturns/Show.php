<?php

namespace App\Livewire\OrderItemsReturns;

use App\Livewire\Forms\OrderItemsReturnForm;
use App\Models\OrderItemsReturn;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public OrderItemsReturnForm $form;

    public function mount(OrderItemsReturn $orderItemsReturn)
    {
        $this->form->setOrderItemsReturnModel($orderItemsReturn);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.order-items-return.show', ['orderItemsReturn' => $this->form->orderItemsReturnModel]);
    }
}
