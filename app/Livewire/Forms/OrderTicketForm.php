<?php

namespace App\Livewire\Forms;

use App\Models\OrderTicket;
use Livewire\Form;

class OrderTicketForm extends Form
{
    public ?OrderTicket $orderTicketModel;
    
    public $user_id = '';
    public $order_id = '';
    public $ticket_process_by_user = '';
    public $subject = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'subject' => 'required|string',
			'status' => 'required',
        ];
    }

    public function setOrderTicketModel(OrderTicket $orderTicketModel): void
    {
        $this->orderTicketModel = $orderTicketModel;
        
        $this->user_id = $this->orderTicketModel->user_id;
        $this->order_id = $this->orderTicketModel->order_id;
        $this->ticket_process_by_user = $this->orderTicketModel->ticket_process_by_user;
        $this->subject = $this->orderTicketModel->subject;
        $this->status = $this->orderTicketModel->status;
    }

    public function store(): void
    {
        $this->orderTicketModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->orderTicketModel->update($this->validate());

        $this->reset();
    }
}
