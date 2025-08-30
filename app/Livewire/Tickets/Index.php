<?php

namespace App\Livewire\Tickets;

use App\Models\Ticket;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    #[Layout('layouts.app')]
    public function render(): View
    {
        $tickets = Ticket::search($this->search)->with('admin','user','ticketReplies')->paginate();

        return view('livewire.ticket.index', compact('tickets'))
            ->with('i', $this->getPage() * $tickets->perPage());
    }

    public function searchTickets($term){
        $this->search  = $term;
    }

    public function delete(Ticket $ticket)
    {
        $ticket->delete();

        return $this->redirectRoute('tickets.index', navigate: true);
    }
}
