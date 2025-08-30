<?php

namespace App\Livewire\Forms;

use App\Models\ProductBrand;
use Livewire\Form;

class ProductBrandForm extends Form
{
    public ?ProductBrand $productBrandModel;
    
    public $name = '';
    public $logo = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'name' => 'required|string',
			'logo' => 'string',
			'status' => 'required',
        ];
    }

    public function setProductBrandModel(ProductBrand $productBrandModel): void
    {
        $this->productBrandModel = $productBrandModel;
        
        $this->name = $this->productBrandModel->name;
        $this->logo = $this->productBrandModel->logo;
        $this->status = $this->productBrandModel->status;
    }

    public function store(): void
    {
        $this->productBrandModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->productBrandModel->update($this->validate());

        $this->reset();
    }
}
