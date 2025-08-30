<?php

namespace App\Livewire\ProductPromotions;

use App\Livewire\Forms\ProductPromotionForm;
use App\Models\ProductPromotion;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public ProductPromotionForm $form;

    public function mount(ProductPromotion $productPromotion)
    {
        $this->form->setProductPromotionModel($productPromotion);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('product-promotions.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-promotion.create');
    }
}
