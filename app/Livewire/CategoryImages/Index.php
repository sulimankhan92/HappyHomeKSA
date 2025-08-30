<?php

namespace App\Livewire\CategoryImages;

use App\Models\CategoryImage;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    public function render(): View
    {
        $categoryImages = CategoryImage::paginate();

        return view('livewire.category-image.index', compact('categoryImages'))
            ->with('i', $this->getPage() * $categoryImages->perPage());
    }

    public function delete(CategoryImage $categoryImage)
    {
        $categoryImage->delete();

        return $this->redirectRoute('category-images.index', navigate: true);
    }
}
