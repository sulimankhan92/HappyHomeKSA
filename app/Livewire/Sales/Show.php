<?php

namespace App\Livewire\Sales;

use App\Livewire\Forms\SaleForm;
use App\Models\Sale;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public SaleForm $form;

    public function mount(Sale $sale)
    {
        $this->form->setSaleModel($sale);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.sale.show', ['sale' => $this->form->saleModel]);
    }
}
