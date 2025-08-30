<?php

namespace App\Livewire\Forms;

use App\Models\PurchasesReturn;
use Livewire\Form;

class PurchasesReturnForm extends Form
{
    public ?PurchasesReturn $purchasesReturnModel;
    
    public $supplier_id = '';
    public $created_by = '';
    public $total_tax = '';
    public $shipping_cost = '';
    public $total_discount = '';
    public $total_amount = '';
    public $paid_amount = '';
    public $notes = '';
    public $status = '';
    public $invoice_no = '';
    public $invoice_date = '';

    public function rules(): array
    {
        return [
			'supplier_id' => 'required',
			'created_by' => 'required',
			'total_tax' => 'required',
			'shipping_cost' => 'required',
			'total_discount' => 'required',
			'total_amount' => 'required',
			'paid_amount' => 'required',
			'notes' => 'string',
			'status' => 'required',
			'invoice_no' => 'required|string',
        ];
    }

    public function setPurchasesReturnModel(PurchasesReturn $purchasesReturnModel): void
    {
        $this->purchasesReturnModel = $purchasesReturnModel;
        
        $this->supplier_id = $this->purchasesReturnModel->supplier_id;
        $this->created_by = $this->purchasesReturnModel->created_by;
        $this->total_tax = $this->purchasesReturnModel->total_tax;
        $this->shipping_cost = $this->purchasesReturnModel->shipping_cost;
        $this->total_discount = $this->purchasesReturnModel->total_discount;
        $this->total_amount = $this->purchasesReturnModel->total_amount;
        $this->paid_amount = $this->purchasesReturnModel->paid_amount;
        $this->notes = $this->purchasesReturnModel->notes;
        $this->status = $this->purchasesReturnModel->status;
        $this->invoice_no = $this->purchasesReturnModel->invoice_no;
        $this->invoice_date = $this->purchasesReturnModel->invoice_date;
    }

    public function store(): void
    {
        $this->purchasesReturnModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->purchasesReturnModel->update($this->validate());

        $this->reset();
    }
}
