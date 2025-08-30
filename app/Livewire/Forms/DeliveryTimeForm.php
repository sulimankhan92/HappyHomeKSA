<?php

namespace App\Livewire\Forms;

use App\Models\DeliveryTime;
use Livewire\Form;

class DeliveryTimeForm extends Form
{
    public ?DeliveryTime $deliveryTimeModel;
    
    public $time_slot = '';
    public $urgent_basis = '';

    public function rules(): array
    {
        return [
			'time_slot' => 'required|string',
			'urgent_basis' => 'required',
        ];
    }

    public function setDeliveryTimeModel(DeliveryTime $deliveryTimeModel): void
    {
        $this->deliveryTimeModel = $deliveryTimeModel;
        
        $this->time_slot = $this->deliveryTimeModel->time_slot;
        $this->urgent_basis = $this->deliveryTimeModel->urgent_basis;
    }

    public function store(): void
    {
        $this->deliveryTimeModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->deliveryTimeModel->update($this->validate());

        $this->reset();
    }
}
