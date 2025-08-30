<?php

namespace App\Livewire\ProductBrands;

use App\Models\ProductBrand;
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
        $productBrands = ProductBrand::paginate();

        return view('livewire.product-brand.index', compact('productBrands'))
            ->with('i', $this->getPage() * $productBrands->perPage());
    }

    public function delete(ProductBrand $productBrand)
    {
        $productBrand->delete();

        return $this->redirectRoute('product-brands.index', navigate: true);
    }
}
