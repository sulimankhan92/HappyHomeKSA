<?php

namespace App\Livewire\ProductPackings;

use App\Models\ProductPacking;
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
        $productPackings = ProductPacking::search($this->search)->paginate();

        return view('livewire.product-packing.index', compact('productPackings'))
            ->with('i', $this->getPage() * $productPackings->perPage());
    }

    public function searchProductPackings($term)
    {
        $this->search = $term;
    }

    public function delete(ProductPacking $productPacking)
    {
        $productPacking->delete();

        return $this->redirectRoute('product-packings.index', navigate: true);
    }
}
