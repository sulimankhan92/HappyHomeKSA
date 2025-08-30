<?php

namespace App\Livewire\ProductBrands;

use App\Livewire\Forms\ProductBrandForm;
use App\Models\ProductBrand;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public ProductBrandForm $form;

    public function mount(ProductBrand $productBrand)
    {
        $this->form->setProductBrandModel($productBrand);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-brand.show', ['productBrand' => $this->form->productBrandModel]);
    }
}
