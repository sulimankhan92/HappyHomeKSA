<?php

namespace App\Livewire\ProductVariants;

use App\Livewire\Forms\ProductVariantForm;
use App\Models\ProductVariant;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public ProductVariantForm $form;

    public function mount(ProductVariant $productVariant)
    {
        $this->form->setProductVariantModel($productVariant);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('product-variants.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-variant.edit');
    }
}
