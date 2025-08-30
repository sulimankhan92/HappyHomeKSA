<?php

namespace App\Livewire\PurchaseReturnItems;

use App\Livewire\Forms\PurchaseReturnItemForm;
use App\Models\PurchaseReturnItem;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public PurchaseReturnItemForm $form;

    public function mount(PurchaseReturnItem $purchaseReturnItem)
    {
        $this->form->setPurchaseReturnItemModel($purchaseReturnItem);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('purchase-return-items.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.purchase-return-item.edit');
    }
}
