<?php

namespace App\Livewire\ProductPackings;

use App\Livewire\Forms\ProductPackingForm;
use App\Models\ProductPacking;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public ProductPackingForm $form;

    public function mount(ProductPacking $productPacking)
    {
        $this->form->setProductPackingModel($productPacking);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-packing.show', ['productPacking' => $this->form->productPackingModel]);
    }
}
