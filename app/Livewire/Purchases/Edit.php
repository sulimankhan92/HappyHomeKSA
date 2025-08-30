<?php

namespace App\Livewire\Purchases;

use App\Livewire\Forms\PurchaseForm;
use App\Models\Purchase;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public PurchaseForm $form;

    public function mount(Purchase $purchase)
    {
        $this->form->setPurchaseModel($purchase);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('purchases.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.purchase.edit');
    }
}
