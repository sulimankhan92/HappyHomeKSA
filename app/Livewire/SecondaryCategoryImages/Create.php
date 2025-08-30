<?php

namespace App\Livewire\SecondaryCategoryImages;

use App\Livewire\Forms\SecondaryCategoryImageForm;
use App\Models\SecondaryCategoryImage;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public SecondaryCategoryImageForm $form;

    public function mount(SecondaryCategoryImage $secondaryCategoryImage)
    {
        $this->form->setSecondaryCategoryImageModel($secondaryCategoryImage);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('secondary-category-images.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.secondary-category-image.create');
    }
}
