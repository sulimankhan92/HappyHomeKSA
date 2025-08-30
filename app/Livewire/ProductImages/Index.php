<?php

namespace App\Livewire\ProductImages;

use App\Models\ProductImage;
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
        $productImages = ProductImage::paginate();

        return view('livewire.product-image.index', compact('productImages'))
            ->with('i', $this->getPage() * $productImages->perPage());
    }

    public function delete(ProductImage $productImage)
    {
        $productImage->delete();

        return $this->redirectRoute('product-images.index', navigate: true);
    }
}
