<?php

namespace App\Livewire\ProductDetails;

use App\Livewire\Forms\ProductDetailForm;
use App\Models\ProductDetail;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public ProductDetailForm $form;

    public function mount(ProductDetail $productDetail)
    {
        $this->form->setProductDetailModel($productDetail);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-detail.show', ['productDetail' => $this->form->productDetailModel]);
    }
}
