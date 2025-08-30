<?php

namespace App\Livewire\OrderTickets;

use App\Livewire\Forms\OrderTicketForm;
use App\Models\OrderTicket;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public OrderTicketForm $form;

    public function mount(OrderTicket $orderTicket)
    {
        $this->form->setOrderTicketModel($orderTicket);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.order-ticket.show', ['orderTicket' => $this->form->orderTicketModel]);
    }
}
