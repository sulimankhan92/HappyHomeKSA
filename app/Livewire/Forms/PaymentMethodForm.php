<?php

namespace App\Livewire\Forms;

use App\Models\PaymentMethod;
use Livewire\Form;

class PaymentMethodForm extends Form
{
    public ?PaymentMethod $paymentMethodModel;
    
    public $user_id = '';
    public $name_en = '';
    public $name_ar = '';
    public $description_en = '';
    public $description_ar = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'name_en' => 'required|string',
			'name_ar' => 'required|string',
			'description_en' => 'string',
			'description_ar' => 'string',
			'status' => 'required',
        ];
    }

    public function setPaymentMethodModel(PaymentMethod $paymentMethodModel): void
    {
        $this->paymentMethodModel = $paymentMethodModel;
        
        $this->user_id = $this->paymentMethodModel->user_id;
        $this->name_en = $this->paymentMethodModel->name_en;
        $this->name_ar = $this->paymentMethodModel->name_ar;
        $this->description_en = $this->paymentMethodModel->description_en;
        $this->description_ar = $this->paymentMethodModel->description_ar;
        $this->status = $this->paymentMethodModel->status;
    }

    public function store(): void
    {
        $this->paymentMethodModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->paymentMethodModel->update($this->validate());

        $this->reset();
    }
}
