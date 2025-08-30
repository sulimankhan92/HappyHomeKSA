<?php

namespace App\Livewire\OrderTickets;

use App\Livewire\Forms\OrderTicketForm;
use App\Models\OrderTicket;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public OrderTicketForm $form;

    public function mount(OrderTicket $orderTicket)
    {
        $this->form->setOrderTicketModel($orderTicket);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('order-tickets.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.order-ticket.edit');
    }
}
