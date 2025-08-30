<?php

namespace App\Livewire\ProductDetails;

use App\Models\ProductDetail;
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
        $productDetails = ProductDetail::paginate();

        return view('livewire.product-detail.index', compact('productDetails'))
            ->with('i', $this->getPage() * $productDetails->perPage());
    }

    public function delete(ProductDetail $productDetail)
    {
        $productDetail->delete();

        return $this->redirectRoute('product-details.index', navigate: true);
    }
}
