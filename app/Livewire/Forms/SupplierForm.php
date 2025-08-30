<?php

namespace App\Livewire\Forms;

use App\Models\Supplier;
use Livewire\Form;

class SupplierForm extends Form
{
    public ?Supplier $supplierModel;
    
    public $name = '';
    public $company_name = '';
    public $vat_number = '';
    public $phone_number = '';
    public $image = '';
    public $country = '';
    public $address = '';
    public $location_link = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'name' => 'required|string',
			'company_name' => 'string',
			'vat_number' => 'string',
			'phone_number' => 'string',
			'image' => 'string',
			'country' => 'string',
			'address' => 'string',
			'location_link' => 'string',
			'status' => 'required',
        ];
    }

    public function setSupplierModel(Supplier $supplierModel): void
    {
        $this->supplierModel = $supplierModel;
        
        $this->name = $this->supplierModel->name;
        $this->company_name = $this->supplierModel->company_name;
        $this->vat_number = $this->supplierModel->vat_number;
        $this->phone_number = $this->supplierModel->phone_number;
        $this->image = $this->supplierModel->image;
        $this->country = $this->supplierModel->country;
        $this->address = $this->supplierModel->address;
        $this->location_link = $this->supplierModel->location_link;
        $this->status = $this->supplierModel->status;
    }

    public function store(): void
    {
        $this->supplierModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->supplierModel->update($this->validate());

        $this->reset();
    }
}
