<?php

namespace App\Livewire\Products;

use App\Models\Product;
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
        $products = Product::search($this->search)->with('productManufacturer','productImages','secondaryCategories')
            ->orderBy('id', 'desc')
            ->paginate();
        return view('livewire.product.index', compact('products'))
            ->with('i', $this->getPage() * $products->perPage());
    }

    public function searchProduct($term){
        $this->search = $term;
    }

    public function delete(Product $product)
    {
        $product->delete();

        return $this->redirectRoute('products.index', navigate: true);
    }
}
