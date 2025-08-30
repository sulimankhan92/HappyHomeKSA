<?php

namespace App\Livewire\ProductBatches;

use App\Livewire\Forms\ProductBatchForm;
use App\Models\ProductBatch;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public ProductBatchForm $form;

    public function mount(ProductBatch $productBatch)
    {
        $this->form->setProductBatchModel($productBatch);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('product-batches.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-batch.edit');
    }
}
