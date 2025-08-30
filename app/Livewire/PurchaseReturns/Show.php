<?php

namespace App\Livewire\PurchaseReturns;

use App\Livewire\Forms\PurchaseReturnForm;
use App\Models\PurchaseReturn;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public PurchaseReturnForm $form;

    public function mount(PurchaseReturn $purchaseReturn)
    {
        $this->form->setPurchaseReturnModel($purchaseReturn);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.purchase-return.show', ['purchaseReturn' => $this->form->purchaseReturnModel]);
    }
}
