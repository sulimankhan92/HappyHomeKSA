<?php

namespace App\Livewire\Tickets;

use App\Livewire\Forms\TicketForm;
use App\Models\Ticket;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public TicketForm $form;

    public function mount(Ticket $ticket)
    {
        $this->form->setTicketModel($ticket);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.ticket.show', ['ticket' => $this->form->ticketModel]);
    }
}
