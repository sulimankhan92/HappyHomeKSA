<?php

namespace App\Livewire\ProductManufacturers;

use App\Models\ProductManufacturer;
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
        $productManufacturers = ProductManufacturer::search($this->search)->with('country','user')->paginate();

        return view('livewire.product-manufacturer.index', compact('productManufacturers'))
            ->with('i', $this->getPage() * $productManufacturers->perPage());
    }

    public function searchProductManufacturer($term)
    {
        $this->search = $term;
    }

    public function delete(ProductManufacturer $productManufacturer)
    {
        $productManufacturer->delete();

        return $this->redirectRoute('product-manufacturers.index', navigate: true);
    }
}
