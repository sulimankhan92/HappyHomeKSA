<?php

namespace App\Livewire\CategoryImages;

use App\Livewire\Forms\CategoryImageForm;
use App\Models\CategoryImage;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public CategoryImageForm $form;

    public function mount(CategoryImage $categoryImage)
    {
        $this->form->setCategoryImageModel($categoryImage);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('category-images.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.category-image.edit');
    }
}
