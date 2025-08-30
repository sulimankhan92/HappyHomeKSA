<?php

namespace App\Livewire\OrdersHistories;

use App\Livewire\Forms\OrdersHistoryForm;
use App\Models\OrdersHistory;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public OrdersHistoryForm $form;

    public function mount(OrdersHistory $ordersHistory)
    {
        $this->form->setOrdersHistoryModel($ordersHistory);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('orders-histories.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.orders-history.create');
    }
}
