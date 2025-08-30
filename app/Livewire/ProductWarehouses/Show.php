<?php

namespace App\Livewire\ProductWarehouses;

use App\Livewire\Forms\ProductWarehouseForm;
use App\Models\ProductWarehouse;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public ProductWarehouseForm $form;

    public function mount(ProductWarehouse $productWarehouse)
    {
        $this->form->setProductWarehouseModel($productWarehouse);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-warehouse.show', ['productWarehouse' => $this->form->productWarehouseModel]);
    }
}
