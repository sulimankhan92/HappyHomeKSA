<?php

namespace App\Livewire\ProductManufacturers;

use App\Livewire\Forms\ProductManufacturerForm;
use App\Models\ProductManufacturer;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public ProductManufacturerForm $form;

    public function mount(ProductManufacturer $productManufacturer)
    {
        $this->form->setProductManufacturerModel($productManufacturer);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-manufacturer.show', ['productManufacturer' => $this->form->productManufacturerModel]);
    }
}
