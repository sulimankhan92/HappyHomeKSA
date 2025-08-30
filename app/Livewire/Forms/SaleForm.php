<?php

namespace App\Livewire\Forms;

use App\Models\Sale;
use Livewire\Form;

class SaleForm extends Form
{
    public ?Sale $saleModel;
    
    public $customer_id = '';
    public $created_by = '';
    public $sale_date = '';
    public $total_amount = '';
    public $notes = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'sale_date' => 'required',
			'total_amount' => 'required',
			'notes' => 'string',
			'status' => 'required',
        ];
    }

    public function setSaleModel(Sale $saleModel): void
    {
        $this->saleModel = $saleModel;
        
        $this->customer_id = $this->saleModel->customer_id;
        $this->created_by = $this->saleModel->created_by;
        $this->sale_date = $this->saleModel->sale_date;
        $this->total_amount = $this->saleModel->total_amount;
        $this->notes = $this->saleModel->notes;
        $this->status = $this->saleModel->status;
    }

    public function store(): void
    {
        $this->saleModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->saleModel->update($this->validate());

        $this->reset();
    }
}
