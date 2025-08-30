<?php

namespace App\Livewire\Forms;

use App\Models\OrderItemsReturn;
use Livewire\Form;

class OrderItemsReturnForm extends Form
{
    public ?OrderItemsReturn $orderItemsReturnModel;
    
    public $order_id = '';
    public $order_item_id = '';
    public $return_quantity = '';
    public $reason_subject = '';
    public $return_reason = '';

    public function rules(): array
    {
        return [
			'return_quantity' => 'required',
			'reason_subject' => 'string',
			'return_reason' => 'string',
        ];
    }

    public function setOrderItemsReturnModel(OrderItemsReturn $orderItemsReturnModel): void
    {
        $this->orderItemsReturnModel = $orderItemsReturnModel;
        
        $this->order_id = $this->orderItemsReturnModel->order_id;
        $this->order_item_id = $this->orderItemsReturnModel->order_item_id;
        $this->return_quantity = $this->orderItemsReturnModel->return_quantity;
        $this->reason_subject = $this->orderItemsReturnModel->reason_subject;
        $this->return_reason = $this->orderItemsReturnModel->return_reason;
    }

    public function store(): void
    {
        $this->orderItemsReturnModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->orderItemsReturnModel->update($this->validate());

        $this->reset();
    }
}
