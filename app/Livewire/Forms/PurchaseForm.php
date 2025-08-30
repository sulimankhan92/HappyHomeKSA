<?php

namespace App\Livewire\Forms;

use App\Models\Purchase;
use Livewire\Form;

class PurchaseForm extends Form
{
    public ?Purchase $purchaseModel;
    
    public $supplier_id = '';
    public $created_by = '';
    public $purchase_date = '';
    public $total_tax = '';
    public $shipping_cost = '';
    public $total_discount = '';
    public $total_amount = '';
    public $paid_amount = '';
    public $notes = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'purchase_date' => 'required',
			'total_tax' => 'required',
			'shipping_cost' => 'required',
			'total_discount' => 'required',
			'total_amount' => 'required',
			'paid_amount' => 'required',
			'notes' => 'string',
			'status' => 'required',
        ];
    }

    public function setPurchaseModel(Purchase $purchaseModel): void
    {
        $this->purchaseModel = $purchaseModel;
        
        $this->supplier_id = $this->purchaseModel->supplier_id;
        $this->created_by = $this->purchaseModel->created_by;
        $this->purchase_date = $this->purchaseModel->purchase_date;
        $this->total_tax = $this->purchaseModel->total_tax;
        $this->shipping_cost = $this->purchaseModel->shipping_cost;
        $this->total_discount = $this->purchaseModel->total_discount;
        $this->total_amount = $this->purchaseModel->total_amount;
        $this->paid_amount = $this->purchaseModel->paid_amount;
        $this->notes = $this->purchaseModel->notes;
        $this->status = $this->purchaseModel->status;
    }

    public function store(): void
    {
        $this->purchaseModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->purchaseModel->update($this->validate());

        $this->reset();
    }
}
