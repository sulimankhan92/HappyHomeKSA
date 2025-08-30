<?php

namespace App\Livewire\TicketReplies;

use App\Models\TicketReply;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    public function render(): View
    {
        $ticketReplies = TicketReply::paginate();

        return view('livewire.ticket-reply.index', compact('ticketReplies'))
            ->with('i', $this->getPage() * $ticketReplies->perPage());
    }

    public function delete(TicketReply $ticketReply)
    {
        $ticketReply->delete();

        return $this->redirectRoute('ticket-replies.index', navigate: true);
    }
}
