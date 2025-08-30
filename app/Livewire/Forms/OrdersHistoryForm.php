<?php

namespace App\Livewire\Forms;

use App\Models\OrdersHistory;
use Livewire\Form;

class OrdersHistoryForm extends Form
{
    public ?OrdersHistory $ordersHistoryModel;
    
    public $order_id = '';
    public $user_id = '';
    public $comments = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'comments' => 'string',
			'status' => 'required',
        ];
    }

    public function setOrdersHistoryModel(OrdersHistory $ordersHistoryModel): void
    {
        $this->ordersHistoryModel = $ordersHistoryModel;
        
        $this->order_id = $this->ordersHistoryModel->order_id;
        $this->user_id = $this->ordersHistoryModel->user_id;
        $this->comments = $this->ordersHistoryModel->comments;
        $this->status = $this->ordersHistoryModel->status;
    }

    public function store(): void
    {
        $this->ordersHistoryModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->ordersHistoryModel->update($this->validate());

        $this->reset();
    }
}
