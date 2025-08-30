<?php

namespace App\Livewire\Forms;

use App\Models\ProductDetail;
use Livewire\Form;

class ProductDetailForm extends Form
{
    public ?ProductDetail $productDetailModel;
    
    public $product_variant_id = '';
    public $product_packaging_id = '';
    public $created_by = '';
    public $price = '';
    public $quantity_to_show_alerts = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'price' => 'required',
			'status' => 'required',
        ];
    }

    public function setProductDetailModel(ProductDetail $productDetailModel): void
    {
        $this->productDetailModel = $productDetailModel;
        
        $this->product_variant_id = $this->productDetailModel->product_variant_id;
        $this->product_packaging_id = $this->productDetailModel->product_packaging_id;
        $this->created_by = $this->productDetailModel->created_by;
        $this->price = $this->productDetailModel->price;
        $this->quantity_to_show_alerts = $this->productDetailModel->quantity_to_show_alerts;
        $this->status = $this->productDetailModel->status;
    }

    public function store(): void
    {
        $this->productDetailModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->productDetailModel->update($this->validate());

        $this->reset();
    }
}
