<?php

namespace App\Livewire\Forms;

use App\Models\PurchaseReturn;
use Livewire\Form;

class PurchaseReturnForm extends Form
{
    public ?PurchaseReturn $purchaseReturnModel;
    
    public $purchase_id = '';
    public $return_date = '';
    public $reason = '';
    public $total_refunded = '';

    public function rules(): array
    {
        return [
			'purchase_id' => 'required',
			'reason' => 'string',
        ];
    }

    public function setPurchaseReturnModel(PurchaseReturn $purchaseReturnModel): void
    {
        $this->purchaseReturnModel = $purchaseReturnModel;
        
        $this->purchase_id = $this->purchaseReturnModel->purchase_id;
        $this->return_date = $this->purchaseReturnModel->return_date;
        $this->reason = $this->purchaseReturnModel->reason;
        $this->total_refunded = $this->purchaseReturnModel->total_refunded;
    }

    public function store(): void
    {
        $this->purchaseReturnModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->purchaseReturnModel->update($this->validate());

        $this->reset();
    }
}
