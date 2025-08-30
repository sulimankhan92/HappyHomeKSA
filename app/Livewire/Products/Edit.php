<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public ProductForm $form;

    public function mount(Product $product)
    {
        $this->form->setProductModel($product);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('products.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product.edit');
    }
}
