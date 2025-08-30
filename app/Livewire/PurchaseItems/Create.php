<?php

namespace App\Livewire\PurchaseItems;

use App\Livewire\Forms\PurchaseItemForm;
use App\Models\PurchaseItem;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public PurchaseItemForm $form;

    public function mount(PurchaseItem $purchaseItem)
    {
        $this->form->setPurchaseItemModel($purchaseItem);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('purchase-items.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.purchase-item.create');
    }
}
