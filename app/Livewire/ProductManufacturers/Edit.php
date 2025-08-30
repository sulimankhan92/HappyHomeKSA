<?php

namespace App\Livewire\ProductManufacturers;

use App\Livewire\Forms\ProductManufacturerForm;
use App\Models\ProductManufacturer;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public ProductManufacturerForm $form;

    public function mount(ProductManufacturer $productManufacturer)
    {
        $this->form->setProductManufacturerModel($productManufacturer);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('product-manufacturers.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-manufacturer.edit');
    }
}
