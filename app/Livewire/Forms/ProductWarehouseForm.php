<?php

namespace App\Livewire\Forms;

use App\Models\ProductWarehouse;
use Livewire\Form;

class ProductWarehouseForm extends Form
{
    public ?ProductWarehouse $productWarehouseModel;
    
    public $created_by = '';
    public $name_en = '';
    public $name_ar = '';
    public $address = '';
    public $phone_number = '';
    public $location_link = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'name_en' => 'required|string',
			'name_ar' => 'required|string',
			'address' => 'required|string',
			'phone_number' => 'required|string',
			'location_link' => 'string',
			'status' => 'required',
        ];
    }

    public function setProductWarehouseModel(ProductWarehouse $productWarehouseModel): void
    {
        $this->productWarehouseModel = $productWarehouseModel;
        
        $this->created_by = $this->productWarehouseModel->created_by;
        $this->name_en = $this->productWarehouseModel->name_en;
        $this->name_ar = $this->productWarehouseModel->name_ar;
        $this->address = $this->productWarehouseModel->address;
        $this->phone_number = $this->productWarehouseModel->phone_number;
        $this->location_link = $this->productWarehouseModel->location_link;
        $this->status = $this->productWarehouseModel->status;
    }

    public function store(): void
    {
        $this->productWarehouseModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->productWarehouseModel->update($this->validate());

        $this->reset();
    }
}
