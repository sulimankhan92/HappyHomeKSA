<?php

namespace App\Livewire\OrderItemsReturns;

use App\Livewire\Forms\OrderItemsReturnForm;
use App\Models\OrderItemsReturn;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public OrderItemsReturnForm $form;

    public function mount(OrderItemsReturn $orderItemsReturn)
    {
        $this->form->setOrderItemsReturnModel($orderItemsReturn);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('order-items-returns.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.order-items-return.edit');
    }
}
