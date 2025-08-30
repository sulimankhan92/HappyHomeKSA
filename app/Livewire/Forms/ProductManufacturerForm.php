<?php

namespace App\Livewire\Forms;

use App\Models\ProductManufacturer;
use Livewire\Form;

class ProductManufacturerForm extends Form
{
    public ?ProductManufacturer $productManufacturerModel;

    public $country_id = '';
    public $created_by = '';
    public $name_en = '';
    public $name_ar = '';
    public $description_en = '';
    public $description_ar = '';
    public $logo = '';
    public $status = '';

    public function rules(): array
    {
        return [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'description_en' => 'string',
            'description_ar' => 'string',
            'logo' => 'string',
            'status' => 'required',
            'country_id' => 'required|exists:countries,id',
        ];
    }

    public function setProductManufacturerModel(ProductManufacturer $productManufacturerModel): void
    {
        $this->productManufacturerModel = $productManufacturerModel;

        $this->country_id = $this->productManufacturerModel->country_id;
        $this->created_by = $this->productManufacturerModel->created_by;
        $this->name_en = $this->productManufacturerModel->name_en;
        $this->name_ar = $this->productManufacturerModel->name_ar;
        $this->description_en = $this->productManufacturerModel->description_en;
        $this->description_ar = $this->productManufacturerModel->description_ar;
        $this->logo = $this->productManufacturerModel->logo;
        $this->status = $this->productManufacturerModel->status;
    }

    public function store(): void
    {
        $validatedData = $this->validate();

        $validatedData['created_by'] =  auth()->id();

        $this->productManufacturerModel->create($validatedData);

//        $this->productManufacturerModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->productManufacturerModel->update($this->validate());

        $this->reset();
    }
}
