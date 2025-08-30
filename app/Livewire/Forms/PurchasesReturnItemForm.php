<?php

namespace App\Livewire\Forms;

use App\Models\PurchasesReturnItem;
use Livewire\Form;

class PurchasesReturnItemForm extends Form
{
    public ?PurchasesReturnItem $purchasesReturnItemModel;
    
    public $purchases_return_id = '';
    public $product_variant_id = '';
    public $quantity = '';
    public $unit_price = '';
    public $expiry_date = '';
    public $purchase_price = '';
    public $sale_price = '';
    public $item_total = '';
    public $old_qty = '';
    public $old_expiry_date = '';
    public $old_expiry_status = '';
    public $return_reason = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'purchases_return_id' => 'required',
			'product_variant_id' => 'required',
			'quantity' => 'required',
			'unit_price' => 'required',
			'purchase_price' => 'required',
			'sale_price' => 'required',
			'item_total' => 'required',
			'return_reason' => 'string',
			'status' => 'required',
        ];
    }

    public function setPurchasesReturnItemModel(PurchasesReturnItem $purchasesReturnItemModel): void
    {
        $this->purchasesReturnItemModel = $purchasesReturnItemModel;
        
        $this->purchases_return_id = $this->purchasesReturnItemModel->purchases_return_id;
        $this->product_variant_id = $this->purchasesReturnItemModel->product_variant_id;
        $this->quantity = $this->purchasesReturnItemModel->quantity;
        $this->unit_price = $this->purchasesReturnItemModel->unit_price;
        $this->expiry_date = $this->purchasesReturnItemModel->expiry_date;
        $this->purchase_price = $this->purchasesReturnItemModel->purchase_price;
        $this->sale_price = $this->purchasesReturnItemModel->sale_price;
        $this->item_total = $this->purchasesReturnItemModel->item_total;
        $this->old_qty = $this->purchasesReturnItemModel->old_qty;
        $this->old_expiry_date = $this->purchasesReturnItemModel->old_expiry_date;
        $this->old_expiry_status = $this->purchasesReturnItemModel->old_expiry_status;
        $this->return_reason = $this->purchasesReturnItemModel->return_reason;
        $this->status = $this->purchasesReturnItemModel->status;
    }

    public function store(): void
    {
        $this->purchasesReturnItemModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->purchasesReturnItemModel->update($this->validate());

        $this->reset();
    }
}
