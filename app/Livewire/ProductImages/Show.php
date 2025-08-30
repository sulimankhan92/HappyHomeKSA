<?php

namespace App\Livewire\ProductImages;

use App\Livewire\Forms\ProductImageForm;
use App\Models\ProductImage;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public ProductImageForm $form;

    public function mount(ProductImage $productImage)
    {
        $this->form->setProductImageModel($productImage);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-image.show', ['productImage' => $this->form->productImageModel]);
    }
}
