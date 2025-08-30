<?php

namespace App\Livewire\Suppliers;

use App\Livewire\Forms\SupplierForm;
use App\Models\Supplier;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public SupplierForm $form;

    public function mount(Supplier $supplier)
    {
        $this->form->setSupplierModel($supplier);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('suppliers.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.supplier.create');
    }
}
