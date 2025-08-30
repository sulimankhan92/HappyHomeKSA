<?php

namespace App\Livewire\ProductBrands;

use App\Livewire\Forms\ProductBrandForm;
use App\Models\ProductBrand;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public ProductBrandForm $form;

    public function mount(ProductBrand $productBrand)
    {
        $this->form->setProductBrandModel($productBrand);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('product-brands.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-brand.edit');
    }
}
