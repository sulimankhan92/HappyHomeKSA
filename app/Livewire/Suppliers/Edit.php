<?php

namespace App\Livewire\Suppliers;

use App\Livewire\Forms\SupplierForm;
use App\Models\Supplier;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public SupplierForm $form;

    public function mount(Supplier $supplier)
    {
        $this->form->setSupplierModel($supplier);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('suppliers.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.supplier.edit');
    }
}
