<?php

namespace App\Livewire\PurchasesReturnItems;

use App\Livewire\Forms\PurchasesReturnItemForm;
use App\Models\PurchasesReturnItem;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public PurchasesReturnItemForm $form;

    public function mount(PurchasesReturnItem $purchasesReturnItem)
    {
        $this->form->setPurchasesReturnItemModel($purchasesReturnItem);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.purchases-return-item.show', ['purchasesReturnItem' => $this->form->purchasesReturnItemModel]);
    }
}
