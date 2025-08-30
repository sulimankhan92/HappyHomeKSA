<?php

namespace App\Livewire\ProductImages;

use App\Livewire\Forms\ProductImageForm;
use App\Models\ProductImage;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public ProductImageForm $form;

    public function mount(ProductImage $productImage)
    {
        $this->form->setProductImageModel($productImage);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('product-images.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-image.edit');
    }
}
