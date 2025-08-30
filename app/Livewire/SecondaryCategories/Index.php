<?php

namespace App\Livewire\SecondaryCategories;

use App\Models\SecondaryCategory;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search = '';

    #[Layout('layouts.app')]
    public function render(): View
    {
        $secondaryCategories = SecondaryCategory::search($this->search)->with('category')->paginate();

//dd($secondaryCategories[0]->category->name_en);
        return view('livewire.secondary-category.index', compact('secondaryCategories'))
            ->with('i', $this->getPage() * $secondaryCategories->perPage());
    }

    public function searchSecondaryCategory($term)
    {
        $this->search = $term;
    }

    public function delete(SecondaryCategory $secondaryCategory)
    {
        $secondaryCategory->delete();

        return $this->redirectRoute('secondary-categories.index', navigate: true);
    }
}
