<?php

namespace App\Livewire\Forms;

use App\Models\ProductBatch;
use Livewire\Form;

class ProductBatchForm extends Form
{
    public ?ProductBatch $productBatchModel;
    
    public $product_variant_id = '';
    public $created_by = '';
    public $batch_no = '';
    public $qty = '';
    public $expired_date = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'batch_no' => 'string',
			'qty' => 'required',
			'expired_date' => 'required',
			'status' => 'required',
        ];
    }

    public function setProductBatchModel(ProductBatch $productBatchModel): void
    {
        $this->productBatchModel = $productBatchModel;
        
        $this->product_variant_id = $this->productBatchModel->product_variant_id;
        $this->created_by = $this->productBatchModel->created_by;
        $this->batch_no = $this->productBatchModel->batch_no;
        $this->qty = $this->productBatchModel->qty;
        $this->expired_date = $this->productBatchModel->expired_date;
        $this->status = $this->productBatchModel->status;
    }

    public function store(): void
    {
        $this->productBatchModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->productBatchModel->update($this->validate());

        $this->reset();
    }
}
