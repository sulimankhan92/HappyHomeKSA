<?php

namespace App\Livewire\SaleItems;

use App\Livewire\Forms\SaleItemForm;
use App\Models\SaleItem;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public SaleItemForm $form;

    public function mount(SaleItem $saleItem)
    {
        $this->form->setSaleItemModel($saleItem);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('sale-items.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.sale-item.edit');
    }
}
