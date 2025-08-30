<?php

namespace App\Livewire\Tickets;

use App\Livewire\Forms\TicketForm;
use App\Models\Ticket;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public TicketForm $form;

    public function mount(Ticket $ticket)
    {
        $this->form->setTicketModel($ticket);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('tickets.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.ticket.edit');
    }
}
