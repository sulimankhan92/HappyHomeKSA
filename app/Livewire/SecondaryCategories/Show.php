<?php

namespace App\Livewire\SecondaryCategories;

use App\Livewire\Forms\SecondaryCategoryForm;
use App\Models\SecondaryCategory;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public SecondaryCategoryForm $form;

    public function mount(SecondaryCategory $secondaryCategory)
    {
        $this->form->setSecondaryCategoryModel($secondaryCategory);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.secondary-category.show', ['secondaryCategory' => $this->form->secondaryCategoryModel]);
    }
}
