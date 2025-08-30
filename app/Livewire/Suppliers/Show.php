<?php

namespace App\Livewire\Suppliers;

use App\Livewire\Forms\SupplierForm;
use App\Models\Supplier;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public SupplierForm $form;

    public function mount(Supplier $supplier)
    {
        $this->form->setSupplierModel($supplier);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.supplier.show', ['supplier' => $this->form->supplierModel]);
    }
}
