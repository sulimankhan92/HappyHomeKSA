<?php

namespace App\Livewire\Forms;

use App\Models\SecondaryCategory;
use Livewire\Form;

class SecondaryCategoryForm extends Form
{
    public ?SecondaryCategory $secondaryCategoryModel;

    public $category_id = '';
    public $name_en = '';
    public $name_ar = '';
    public $detail_en = '';
    public $detail_ar = '';
    public $order = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'category_id' => 'required',
			'name_en' => 'required|string',
			'name_ar' => 'required|string',
			'detail_en' => 'string',
			'detail_ar' => 'string',
			'order' => 'required',
			'status' => 'required',
        ];
    }

    public function setSecondaryCategoryModel(SecondaryCategory $secondaryCategoryModel): void
    {
        $this->secondaryCategoryModel = $secondaryCategoryModel;

        $this->category_id = $this->secondaryCategoryModel->category_id;
        $this->name_en = $this->secondaryCategoryModel->name_en;
        $this->name_ar = $this->secondaryCategoryModel->name_ar;
        $this->detail_en = $this->secondaryCategoryModel->detail_en;
        $this->detail_ar = $this->secondaryCategoryModel->detail_ar;
        $this->order = $this->secondaryCategoryModel->order;
        $this->status = $this->secondaryCategoryModel->status;
    }

    public function store(): void
    {
        $this->secondaryCategoryModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->secondaryCategoryModel->update($this->validate());

        $this->reset();
    }
}
