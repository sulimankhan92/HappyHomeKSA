<?php

namespace App\Livewire\TicketReplies;

use App\Livewire\Forms\TicketReplyForm;
use App\Models\TicketReply;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public TicketReplyForm $form;

    public function mount(TicketReply $ticketReply)
    {
        $this->form->setTicketReplyModel($ticketReply);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('ticket-replies.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.ticket-reply.create');
    }
}
