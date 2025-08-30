<?php

namespace App\Livewire\SecondaryCategoryImages;

use App\Models\SecondaryCategoryImage;
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
        $secondaryCategoryImages = SecondaryCategoryImage::paginate();

        return view('livewire.secondary-category-image.index', compact('secondaryCategoryImages'))
            ->with('i', $this->getPage() * $secondaryCategoryImages->perPage());
    }

    public function delete(SecondaryCategoryImage $secondaryCategoryImage)
    {
        $secondaryCategoryImage->delete();

        return $this->redirectRoute('secondary-category-images.index', navigate: true);
    }
}
