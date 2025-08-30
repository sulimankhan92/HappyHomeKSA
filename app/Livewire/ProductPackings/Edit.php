<?php

namespace App\Livewire\ProductPackings;

use App\Livewire\Forms\ProductPackingForm;
use App\Models\ProductPacking;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public ProductPackingForm $form;

    public function mount(ProductPacking $productPacking)
    {
        $this->form->setProductPackingModel($productPacking);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('product-packings.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-packing.edit');
    }
}
