<?php

namespace App\Livewire\ProductVariants;

use App\Models\ProductVariant;
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
        $productVariants = ProductVariant::paginate();

        return view('livewire.product-variant.index', compact('productVariants'))
            ->with('i', $this->getPage() * $productVariants->perPage());
    }

    public function delete(ProductVariant $productVariant)
    {
        $productVariant->delete();

        return $this->redirectRoute('product-variants.index', navigate: true);
    }
}
