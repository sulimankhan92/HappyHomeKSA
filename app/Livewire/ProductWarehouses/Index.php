<?php

namespace App\Livewire\ProductWarehouses;

use App\Models\ProductWarehouse;
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
        $productWarehouses = ProductWarehouse::paginate();

        return view('livewire.product-warehouse.index', compact('productWarehouses'))
            ->with('i', $this->getPage() * $productWarehouses->perPage());
    }

    public function delete(ProductWarehouse $productWarehouse)
    {
        $productWarehouse->delete();

        return $this->redirectRoute('product-warehouses.index', navigate: true);
    }
}
