<?php

namespace App\Livewire\ProductDetails;

use App\Livewire\Forms\ProductDetailForm;
use App\Models\ProductDetail;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public ProductDetailForm $form;

    public function mount(ProductDetail $productDetail)
    {
        $this->form->setProductDetailModel($productDetail);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('product-details.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-detail.edit');
    }
}
