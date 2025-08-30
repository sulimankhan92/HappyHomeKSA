<?php

namespace App\Livewire\SecondaryCategories;

use App\Livewire\Forms\SecondaryCategoryForm;
use App\Models\SecondaryCategory;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public SecondaryCategoryForm $form;

    public function mount(SecondaryCategory $secondaryCategory)
    {
        $this->form->setSecondaryCategoryModel($secondaryCategory);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('secondary-categories.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.secondary-category.create');
    }
}
