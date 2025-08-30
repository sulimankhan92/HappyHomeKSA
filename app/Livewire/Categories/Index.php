<?php

namespace App\Livewire\Categories;

use App\Models\Category;
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
//        $categories = Category::paginate();
        $categories = Category::search($this->search)->paginate();

        return view('livewire.category.index', compact('categories'))
            ->with('i', $this->getPage() * $categories->perPage());
    }

    public function searchCategory($term)
    {
        $this->search = $term;
    }

    public function delete(Category $category)
    {
        $category->delete();

        return $this->redirectRoute('categories.index', navigate: true);
    }
}
