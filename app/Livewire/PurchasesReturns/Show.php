<?php

namespace App\Livewire\PurchasesReturns;

use App\Livewire\Forms\PurchasesReturnForm;
use App\Models\PurchasesReturn;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public PurchasesReturnForm $form;

    public function mount(PurchasesReturn $purchasesReturn)
    {
        $this->form->setPurchasesReturnModel($purchasesReturn);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.purchases-return.show', ['purchasesReturn' => $this->form->purchasesReturnModel]);
    }
}
