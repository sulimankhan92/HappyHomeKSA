<?php

namespace App\Livewire\Forms;

use App\Models\Ticket;
use Livewire\Form;

class TicketForm extends Form
{
    public ?Ticket $ticketModel;
    
    public $user_id = '';
    public $ticket_process_by = '';
    public $subject = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'subject' => 'required|string',
			'status' => 'required',
        ];
    }

    public function setTicketModel(Ticket $ticketModel): void
    {
        $this->ticketModel = $ticketModel;
        
        $this->user_id = $this->ticketModel->user_id;
        $this->ticket_process_by = $this->ticketModel->ticket_process_by;
        $this->subject = $this->ticketModel->subject;
        $this->status = $this->ticketModel->status;
    }

    public function store(): void
    {
        $this->ticketModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->ticketModel->update($this->validate());

        $this->reset();
    }
}
