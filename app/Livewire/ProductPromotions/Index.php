<?php

namespace App\Livewire\ProductPromotions;

use App\Models\ProductPromotion;
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
        $productPromotions = ProductPromotion::search($this->search)->paginate();

        return view('livewire.product-promotion.index', compact('productPromotions'))
            ->with('i', $this->getPage() * $productPromotions->perPage());
    }

    public function searchProductPromotion($term)
    {
        $this->search = $term;
    }

    public function delete(ProductPromotion $productPromotion)
    {
        $productPromotion->delete();

        return $this->redirectRoute('product-promotions.index', navigate: true);
    }
}
