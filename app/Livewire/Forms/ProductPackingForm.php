<?php

namespace App\Livewire\Forms;

use App\Models\ProductPacking;
use Livewire\Form;

class ProductPackingForm extends Form
{
    public ?ProductPacking $productPackingModel;

    public $created_by = '';
    public $packaging_level = '';
    public $quantity = '';
    public $conversion_rate = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'packaging_level' => 'required|string',
			'quantity' => 'required',
			'conversion_rate' => 'required',
			'status' => 'required',
        ];
    }

    public function setProductPackingModel(ProductPacking $productPackingModel): void
    {
        $this->productPackingModel = $productPackingModel;

        $this->created_by = $this->productPackingModel->created_by;
        $this->packaging_level = $this->productPackingModel->packaging_level;
        $this->quantity = $this->productPackingModel->quantity;
        $this->conversion_rate = $this->productPackingModel->conversion_rate;
        $this->status = $this->productPackingModel->status;
    }

    public function store(): void
    {
        $validatedData = $this->validate();

        $validatedData['created_by'] =  auth()->id();

        $this->productPackingModel->create($validatedData);

//        $this->productPackingModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->productPackingModel->update($this->validate());

        $this->reset();
    }
}
