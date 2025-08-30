<?php

namespace App\Livewire\Forms;

use App\Models\CategoryImage;
use Livewire\Form;

class CategoryImageForm extends Form
{
    public ?CategoryImage $categoryImageModel;
    
    public $category_id = '';
    public $file_name = '';
    public $order = '';
    public $display_status = '';

    public function rules(): array
    {
        return [
			'file_name' => 'string',
			'order' => 'required',
			'display_status' => 'required',
        ];
    }

    public function setCategoryImageModel(CategoryImage $categoryImageModel): void
    {
        $this->categoryImageModel = $categoryImageModel;
        
        $this->category_id = $this->categoryImageModel->category_id;
        $this->file_name = $this->categoryImageModel->file_name;
        $this->order = $this->categoryImageModel->order;
        $this->display_status = $this->categoryImageModel->display_status;
    }

    public function store(): void
    {
        $this->categoryImageModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->categoryImageModel->update($this->validate());

        $this->reset();
    }
}
