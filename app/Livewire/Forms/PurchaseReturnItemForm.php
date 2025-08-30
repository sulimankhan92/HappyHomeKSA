<?php

namespace App\Livewire\Forms;

use App\Models\PurchaseReturnItem;
use Livewire\Form;

class PurchaseReturnItemForm extends Form
{
    public ?PurchaseReturnItem $purchaseReturnItemModel;
    
    public $purchase_return_id = '';
    public $purchase_item_id = '';
    public $quantity_returned = '';
    public $reason_for_return = '';
    public $refund_amount = '';

    public function rules(): array
    {
        return [
			'purchase_return_id' => 'required',
			'purchase_item_id' => 'required',
			'reason_for_return' => 'string',
        ];
    }

    public function setPurchaseReturnItemModel(PurchaseReturnItem $purchaseReturnItemModel): void
    {
        $this->purchaseReturnItemModel = $purchaseReturnItemModel;
        
        $this->purchase_return_id = $this->purchaseReturnItemModel->purchase_return_id;
        $this->purchase_item_id = $this->purchaseReturnItemModel->purchase_item_id;
        $this->quantity_returned = $this->purchaseReturnItemModel->quantity_returned;
        $this->reason_for_return = $this->purchaseReturnItemModel->reason_for_return;
        $this->refund_amount = $this->purchaseReturnItemModel->refund_amount;
    }

    public function store(): void
    {
        $this->purchaseReturnItemModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->purchaseReturnItemModel->update($this->validate());

        $this->reset();
    }
}
