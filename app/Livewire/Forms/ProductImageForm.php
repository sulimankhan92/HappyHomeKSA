<?php

namespace App\Livewire\Forms;

use App\Models\ProductImage;
use Livewire\Form;

class ProductImageForm extends Form
{
    public ?ProductImage $productImageModel;
    
    public $product_id = '';
    public $file_name = '';
    public $order = '';
    public $display_status = '';

    public function rules(): array
    {
        return [
			'file_name' => 'string',
			'order' => 'required',
			'display_status' => 'required',
        ];
    }

    public function setProductImageModel(ProductImage $productImageModel): void
    {
        $this->productImageModel = $productImageModel;
        
        $this->product_id = $this->productImageModel->product_id;
        $this->file_name = $this->productImageModel->file_name;
        $this->order = $this->productImageModel->order;
        $this->display_status = $this->productImageModel->display_status;
    }

    public function store(): void
    {
        $this->productImageModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->productImageModel->update($this->validate());

        $this->reset();
    }
}
