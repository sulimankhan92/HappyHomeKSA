<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use Livewire\Form;

class CategoryForm extends Form
{
    public ?Category $categoryModel;

    public $name_en = '';
    public $name_ar = '';
    public $detail_en = '';
    public $detail_ar = '';
    public $order = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'name_en' => 'required|string',
			'name_ar' => 'required|string',
			'detail_en' => 'string',
			'detail_ar' => 'string',
			'order' => 'required',
			'status' => 'required',
        ];
    }

    public function setCategoryModel(Category $categoryModel): void
    {
        $this->categoryModel = $categoryModel;
        $this->name_en = $this->categoryModel->name_en;
        $this->name_ar = $this->categoryModel->name_ar;
        $this->detail_en = $this->categoryModel->detail_en;
        $this->detail_ar = $this->categoryModel->detail_ar;
        $this->order = $this->categoryModel->order;
        $this->status = $this->categoryModel->status;
    }

    public function store(): void
    {
        $this->categoryModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->categoryModel->update($this->validate());

        $this->reset();
    }
}
