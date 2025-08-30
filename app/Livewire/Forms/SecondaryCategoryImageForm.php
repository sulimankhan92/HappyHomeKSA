<?php

namespace App\Livewire\Forms;

use App\Models\SecondaryCategoryImage;
use Livewire\Form;

class SecondaryCategoryImageForm extends Form
{
    public ?SecondaryCategoryImage $secondaryCategoryImageModel;
    
    public $secondary_category_id = '';
    public $images = '';
    public $order = '';
    public $display_status = '';

    public function rules(): array
    {
        return [
			'images' => 'string',
			'order' => 'required',
			'display_status' => 'required',
        ];
    }

    public function setSecondaryCategoryImageModel(SecondaryCategoryImage $secondaryCategoryImageModel): void
    {
        $this->secondaryCategoryImageModel = $secondaryCategoryImageModel;
        
        $this->secondary_category_id = $this->secondaryCategoryImageModel->secondary_category_id;
        $this->images = $this->secondaryCategoryImageModel->images;
        $this->order = $this->secondaryCategoryImageModel->order;
        $this->display_status = $this->secondaryCategoryImageModel->display_status;
    }

    public function store(): void
    {
        $this->secondaryCategoryImageModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->secondaryCategoryImageModel->update($this->validate());

        $this->reset();
    }
}
