<?php

namespace App\Livewire\Forms;

use App\Models\ProductVariant;
use Livewire\Form;

class ProductVariantForm extends Form
{
    public ?ProductVariant $productVariantModel;

    public $product_id = '';
    public $created_by = '';
    public $unit_id = '';
    public $weight = '';
    public $quantity = '';
    public $expiry_date = '';
    public $expiry_date_alerts = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'weight' => 'required',
			'quantity' => 'required',
			'status' => 'required',
        ];
    }

    public function setProductVariantModel(ProductVariant $productVariantModel): void
    {
        $this->productVariantModel = $productVariantModel;

        $this->product_id = $this->productVariantModel->product_id;
        $this->created_by = $this->productVariantModel->created_by;
        $this->unit_id = $this->productVariantModel->unit_id;
        $this->weight = $this->productVariantModel->weight;
        $this->quantity = $this->productVariantModel->quantity;
        $this->expiry_date = $this->productVariantModel->expiry_date;
        $this->expiry_date_alerts = $this->productVariantModel->expiry_date_alerts;
        $this->status = $this->productVariantModel->status;
    }

    public function store(): void
    {
        $this->productVariantModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->productVariantModel->update($this->validate());

        $this->reset();
    }
}
