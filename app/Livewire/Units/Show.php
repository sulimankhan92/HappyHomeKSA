<?php

namespace App\Livewire\Units;

use App\Livewire\Forms\UnitForm;
use App\Models\Unit;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public UnitForm $form;

    public function mount(Unit $unit)
    {
        $this->form->setUnitModel($unit);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.unit.show', ['unit' => $this->form->unitModel]);
    }
}
