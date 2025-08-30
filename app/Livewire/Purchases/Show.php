<?php

namespace App\Livewire\Purchases;

use App\Livewire\Forms\PurchaseForm;
use App\Models\Purchase;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public PurchaseForm $form;

    public function mount(Purchase $purchase)
    {
        $this->form->setPurchaseModel($purchase);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.purchase.show', ['purchase' => $this->form->purchaseModel]);
    }
}
