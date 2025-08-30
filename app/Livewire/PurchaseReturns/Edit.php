<?php

namespace App\Livewire\PurchaseReturns;

use App\Livewire\Forms\PurchaseReturnForm;
use App\Models\PurchaseReturn;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public PurchaseReturnForm $form;

    public function mount(PurchaseReturn $purchaseReturn)
    {
        $this->form->setPurchaseReturnModel($purchaseReturn);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('purchase-returns.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.purchase-return.edit');
    }
}
