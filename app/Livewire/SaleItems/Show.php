<?php

namespace App\Livewire\SaleItems;

use App\Livewire\Forms\SaleItemForm;
use App\Models\SaleItem;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public SaleItemForm $form;

    public function mount(SaleItem $saleItem)
    {
        $this->form->setSaleItemModel($saleItem);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.sale-item.show', ['saleItem' => $this->form->saleItemModel]);
    }
}
