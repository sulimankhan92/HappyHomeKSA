<?php

namespace App\Livewire\ProductPromotions;

use App\Livewire\Forms\ProductPromotionForm;
use App\Models\ProductPromotion;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public ProductPromotionForm $form;

    public function mount(ProductPromotion $productPromotion)
    {
        $this->form->setProductPromotionModel($productPromotion);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-promotion.show', ['productPromotion' => $this->form->productPromotionModel]);
    }
}
