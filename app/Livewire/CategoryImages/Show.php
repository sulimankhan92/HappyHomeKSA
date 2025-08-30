<?php

namespace App\Livewire\CategoryImages;

use App\Livewire\Forms\CategoryImageForm;
use App\Models\CategoryImage;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public CategoryImageForm $form;

    public function mount(CategoryImage $categoryImage)
    {
        $this->form->setCategoryImageModel($categoryImage);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.category-image.show', ['categoryImage' => $this->form->categoryImageModel]);
    }
}
