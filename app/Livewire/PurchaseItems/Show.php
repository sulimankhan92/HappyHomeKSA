<?php

namespace App\Livewire\PurchaseItems;

use App\Livewire\Forms\PurchaseItemForm;
use App\Models\PurchaseItem;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public PurchaseItemForm $form;

    public function mount(PurchaseItem $purchaseItem)
    {
        $this->form->setPurchaseItemModel($purchaseItem);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.purchase-item.show', ['purchaseItem' => $this->form->purchaseItemModel]);
    }
}
