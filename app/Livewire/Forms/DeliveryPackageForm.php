<?php

namespace App\Livewire\Forms;

use App\Models\DeliveryPackage;
use Livewire\Form;

class DeliveryPackageForm extends Form
{
    public ?DeliveryPackage $deliveryPackageModel;
    
    public $name_ar = '';
    public $name_en = '';
    public $price = '';
    public $urgent_price = '';
    public $time_slot = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'name_ar' => 'required|string',
			'name_en' => 'required|string',
			'price' => 'required',
			'urgent_price' => 'required',
			'time_slot' => 'required|string',
			'status' => 'required',
        ];
    }

    public function setDeliveryPackageModel(DeliveryPackage $deliveryPackageModel): void
    {
        $this->deliveryPackageModel = $deliveryPackageModel;
        
        $this->name_ar = $this->deliveryPackageModel->name_ar;
        $this->name_en = $this->deliveryPackageModel->name_en;
        $this->price = $this->deliveryPackageModel->price;
        $this->urgent_price = $this->deliveryPackageModel->urgent_price;
        $this->time_slot = $this->deliveryPackageModel->time_slot;
        $this->status = $this->deliveryPackageModel->status;
    }

    public function store(): void
    {
        $this->deliveryPackageModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->deliveryPackageModel->update($this->validate());

        $this->reset();
    }
}
