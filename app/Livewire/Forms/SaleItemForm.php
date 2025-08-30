<?php

namespace App\Livewire\Forms;

use App\Models\SaleItem;
use Livewire\Form;

class SaleItemForm extends Form
{
    public ?SaleItem $saleItemModel;
    
    public $customer_id = '';
    public $sale_id = '';
    public $product_variant_id = '';
    public $quantity = '';
    public $unit_price = '';
    public $expiry_date = '';

    public function rules(): array
    {
        return [
			'quantity' => 'required',
			'unit_price' => 'required',
        ];
    }

    public function setSaleItemModel(SaleItem $saleItemModel): void
    {
        $this->saleItemModel = $saleItemModel;
        
        $this->customer_id = $this->saleItemModel->customer_id;
        $this->sale_id = $this->saleItemModel->sale_id;
        $this->product_variant_id = $this->saleItemModel->product_variant_id;
        $this->quantity = $this->saleItemModel->quantity;
        $this->unit_price = $this->saleItemModel->unit_price;
        $this->expiry_date = $this->saleItemModel->expiry_date;
    }

    public function store(): void
    {
        $this->saleItemModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->saleItemModel->update($this->validate());

        $this->reset();
    }
}
