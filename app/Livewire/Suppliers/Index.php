<?php

namespace App\Livewire\Suppliers;

use App\Models\Supplier;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    #[Layout('layouts.app')]
    public function render(): View
    {
        $suppliers = Supplier::search($this->search)->paginate();

        return view('livewire.supplier.index', compact('suppliers'))
            ->with('i', $this->getPage() * $suppliers->perPage());
    }

    public function searchSupplier($term)
    {
        $this->search = $term;
    }

    public function delete(Supplier $supplier)
    {
        $supplier->delete();

        return $this->redirectRoute('suppliers.index', navigate: true);
    }
}
