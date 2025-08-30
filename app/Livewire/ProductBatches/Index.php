<?php

namespace App\Livewire\ProductBatches;

use App\Models\ProductBatch;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    public function render(): View
    {
        $productBatches = ProductBatch::paginate();

        return view('livewire.product-batch.index', compact('productBatches'))
            ->with('i', $this->getPage() * $productBatches->perPage());
    }

    public function delete(ProductBatch $productBatch)
    {
        $productBatch->delete();

        return $this->redirectRoute('product-batches.index', navigate: true);
    }
}
