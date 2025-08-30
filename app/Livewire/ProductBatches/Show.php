<?php

namespace App\Livewire\ProductBatches;

use App\Livewire\Forms\ProductBatchForm;
use App\Models\ProductBatch;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public ProductBatchForm $form;

    public function mount(ProductBatch $productBatch)
    {
        $this->form->setProductBatchModel($productBatch);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-batch.show', ['productBatch' => $this->form->productBatchModel]);
    }
}
