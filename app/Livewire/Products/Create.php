<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public ProductForm $form;

    public function mount(Product $product)
    {
        $this->form->setProductModel($product);
    }

    public function save()
    {
        $product = $this->form->store();

        $this->redirectRoute('product-variants.add-variants', $product->id, ['navigate' => true]);
//        return $this->redirectRoute('products.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product.create');
    }
}
