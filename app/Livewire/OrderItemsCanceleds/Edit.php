<?php

namespace App\Livewire\OrderItemsCanceleds;

use App\Livewire\Forms\OrderItemsCanceledForm;
use App\Models\OrderItemsCanceled;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public OrderItemsCanceledForm $form;

    public function mount(OrderItemsCanceled $orderItemsCanceled)
    {
        $this->form->setOrderItemsCanceledModel($orderItemsCanceled);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('order-items-canceleds.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.order-items-canceled.edit');
    }
}
