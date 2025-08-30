<?php

namespace App\Livewire\OrderItemsCanceleds;

use App\Livewire\Forms\OrderItemsCanceledForm;
use App\Models\OrderItemsCanceled;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public OrderItemsCanceledForm $form;

    public function mount(OrderItemsCanceled $orderItemsCanceled)
    {
        $this->form->setOrderItemsCanceledModel($orderItemsCanceled);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.order-items-canceled.show', ['orderItemsCanceled' => $this->form->orderItemsCanceledModel]);
    }
}
