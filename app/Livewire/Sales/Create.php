<?php

namespace App\Livewire\Sales;

use App\Livewire\Forms\SaleForm;
use App\Models\Sale;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public SaleForm $form;

    public function mount(Sale $sale)
    {
        $this->form->setSaleModel($sale);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('sales.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.sale.create');
    }
}
