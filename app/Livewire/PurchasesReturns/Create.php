<?php

namespace App\Livewire\PurchasesReturns;

use App\Livewire\Forms\PurchasesReturnForm;
use App\Models\PurchasesReturn;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public PurchasesReturnForm $form;

    public function mount(PurchasesReturn $purchasesReturn)
    {
        $this->form->setPurchasesReturnModel($purchasesReturn);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('purchases-returns.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.purchases-return.create');
    }
}
