<?php

namespace App\Livewire\Forms;

use App\Models\PurchaseItem;
use Livewire\Form;

class PurchaseItemForm extends Form
{
    public ?PurchaseItem $purchaseItemModel;
    
    public $purchase_id = '';
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

    public function setPurchaseItemModel(PurchaseItem $purchaseItemModel): void
    {
        $this->purchaseItemModel = $purchaseItemModel;
        
        $this->purchase_id = $this->purchaseItemModel->purchase_id;
        $this->product_variant_id = $this->purchaseItemModel->product_variant_id;
        $this->quantity = $this->purchaseItemModel->quantity;
        $this->unit_price = $this->purchaseItemModel->unit_price;
        $this->expiry_date = $this->purchaseItemModel->expiry_date;
    }

    public function store(): void
    {
        $this->purchaseItemModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->purchaseItemModel->update($this->validate());

        $this->reset();
    }
}
