<?php

namespace App\Livewire\Forms;

use App\Models\TicketReply;
use Livewire\Form;

class TicketReplyForm extends Form
{
    public ?TicketReply $ticketReplyModel;
    
    public $ticket_id = '';
    public $user_id = '';
    public $message = '';
    public $is_user = '';
    public $language = '';

    public function rules(): array
    {
        return [
			'message' => 'required|string',
			'is_user' => 'required',
			'language' => 'required',
        ];
    }

    public function setTicketReplyModel(TicketReply $ticketReplyModel): void
    {
        $this->ticketReplyModel = $ticketReplyModel;
        
        $this->ticket_id = $this->ticketReplyModel->ticket_id;
        $this->user_id = $this->ticketReplyModel->user_id;
        $this->message = $this->ticketReplyModel->message;
        $this->is_user = $this->ticketReplyModel->is_user;
        $this->language = $this->ticketReplyModel->language;
    }

    public function store(): void
    {
        $this->ticketReplyModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->ticketReplyModel->update($this->validate());

        $this->reset();
    }
}
