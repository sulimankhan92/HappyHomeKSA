<?php

namespace App\Livewire\PurchaseReturnItems;

use App\Livewire\Forms\PurchaseReturnItemForm;
use App\Models\PurchaseReturnItem;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public PurchaseReturnItemForm $form;

    public function mount(PurchaseReturnItem $purchaseReturnItem)
    {
        $this->form->setPurchaseReturnItemModel($purchaseReturnItem);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.purchase-return-item.show', ['purchaseReturnItem' => $this->form->purchaseReturnItemModel]);
    }
}
