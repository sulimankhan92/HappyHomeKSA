<?php

namespace App\Livewire\PurchasesReturnItems;

use App\Livewire\Forms\PurchasesReturnItemForm;
use App\Models\PurchasesReturnItem;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public PurchasesReturnItemForm $form;

    public function mount(PurchasesReturnItem $purchasesReturnItem)
    {
        $this->form->setPurchasesReturnItemModel($purchasesReturnItem);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('purchases-return-items.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.purchases-return-item.create');
    }
}
