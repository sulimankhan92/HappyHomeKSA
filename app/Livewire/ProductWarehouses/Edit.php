<?php

namespace App\Livewire\ProductWarehouses;

use App\Livewire\Forms\ProductWarehouseForm;
use App\Models\ProductWarehouse;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public ProductWarehouseForm $form;

    public function mount(ProductWarehouse $productWarehouse)
    {
        $this->form->setProductWarehouseModel($productWarehouse);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('product-warehouses.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.product-warehouse.edit');
    }
}
