<?php

namespace App\Livewire\Units;

use App\Livewire\Forms\UnitForm;
use App\Models\Unit;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{
    public UnitForm $form;

    public function mount(Unit $unit)
    {
        $this->form->setUnitModel($unit);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('units.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.unit.create');
    }
}
