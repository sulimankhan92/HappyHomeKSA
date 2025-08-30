<?php

namespace App\Livewire\Forms;

use App\Models\OrderItem;
use Livewire\Form;

class OrderItemForm extends Form
{
    public ?OrderItem $orderItemModel;
    
    public $order_id = '';
    public $product_detail_id = '';
    public $quantity = '';
    public $price = '';
    public $tax = '';
    public $status = '';
    public $item_note = '';

    public function rules(): array
    {
        return [
			'quantity' => 'required',
			'price' => 'required',
			'tax' => 'required',
			'status' => 'required',
			'item_note' => 'string',
        ];
    }

    public function setOrderItemModel(OrderItem $orderItemModel): void
    {
        $this->orderItemModel = $orderItemModel;
        
        $this->order_id = $this->orderItemModel->order_id;
        $this->product_detail_id = $this->orderItemModel->product_detail_id;
        $this->quantity = $this->orderItemModel->quantity;
        $this->price = $this->orderItemModel->price;
        $this->tax = $this->orderItemModel->tax;
        $this->status = $this->orderItemModel->status;
        $this->item_note = $this->orderItemModel->item_note;
    }

    public function store(): void
    {
        $this->orderItemModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->orderItemModel->update($this->validate());

        $this->reset();
    }
}
