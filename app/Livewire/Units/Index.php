<?php

namespace App\Livewire\Units;

use App\Models\Unit;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    public function render(): View
    {
        $units = Unit::paginate();

        return view('livewire.unit.index', compact('units'))
            ->with('i', $this->getPage() * $units->perPage());
    }

    public function delete(Unit $unit)
    {
        $unit->delete();

        return $this->redirectRoute('units.index', navigate: true);
    }
}
