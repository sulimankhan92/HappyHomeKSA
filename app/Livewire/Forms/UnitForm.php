<?php

namespace App\Livewire\Forms;

use App\Models\Unit;
use Livewire\Form;

class UnitForm extends Form
{
    public ?Unit $unitModel;

    public $name = '';
    public $status = '';
    public $created_by = '';

    public function rules(): array
    {
        return [
			'name' => 'required|string',
			'status' => 'required',
        ];
    }

    public function setUnitModel(Unit $unitModel): void
    {
        $this->unitModel = $unitModel;

        $this->name = $this->unitModel->name;
        $this->status = $this->unitModel->status;
        $this->created_by = $this->unitModel->created_by;
    }

    public function store(): void
    {
        $validatedData = $this->validate();

        $validatedData['created_by'] =  auth()->id();

        $this->unitModel->create($validatedData);
//        $this->unitModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->unitModel->update($this->validate());

        $this->reset();
    }
}
