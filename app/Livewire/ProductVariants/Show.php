<?php

namespace App\Livewire\ProductVariants;

use App\Livewire\Forms\ProductVariantForm;
use App\Models\ProductVariant;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public ProductVariantForm $form;

    public function mount(ProductVariant $productVariant)
    {
        $this->form->setProductVariantModel($productVariant);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-variant.show', ['productVariant' => $this->form->productVariantModel]);
    }
}
