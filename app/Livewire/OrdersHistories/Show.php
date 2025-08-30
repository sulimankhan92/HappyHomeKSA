<?php

namespace App\Livewire\OrdersHistories;

use App\Livewire\Forms\OrdersHistoryForm;
use App\Models\OrdersHistory;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public OrdersHistoryForm $form;

    public function mount(OrdersHistory $ordersHistory)
    {
        $this->form->setOrdersHistoryModel($ordersHistory);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.orders-history.show', ['ordersHistory' => $this->form->ordersHistoryModel]);
    }
}
