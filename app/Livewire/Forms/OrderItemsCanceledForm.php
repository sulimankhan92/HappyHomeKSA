<?php

namespace App\Livewire\Forms;

use App\Models\OrderItemsCanceled;
use Livewire\Form;

class OrderItemsCanceledForm extends Form
{
    public ?OrderItemsCanceled $orderItemsCanceledModel;
    
    public $order_id = '';
    public $order_item_id = '';
    public $canceled_quantity = '';
    public $reason_subject = '';
    public $cancellation_reason = '';

    public function rules(): array
    {
        return [
			'canceled_quantity' => 'required',
			'reason_subject' => 'string',
			'cancellation_reason' => 'string',
        ];
    }

    public function setOrderItemsCanceledModel(OrderItemsCanceled $orderItemsCanceledModel): void
    {
        $this->orderItemsCanceledModel = $orderItemsCanceledModel;
        
        $this->order_id = $this->orderItemsCanceledModel->order_id;
        $this->order_item_id = $this->orderItemsCanceledModel->order_item_id;
        $this->canceled_quantity = $this->orderItemsCanceledModel->canceled_quantity;
        $this->reason_subject = $this->orderItemsCanceledModel->reason_subject;
        $this->cancellation_reason = $this->orderItemsCanceledModel->cancellation_reason;
    }

    public function store(): void
    {
        $this->orderItemsCanceledModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->orderItemsCanceledModel->update($this->validate());

        $this->reset();
    }
}
