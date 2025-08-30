<?php

namespace App\Livewire\Sales;

use App\Models\Sale;
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
        $sales = Sale::search($this->search)->with('customer','user')->paginate();

        return view('livewire.sale.index', compact('sales'))
            ->with('i', $this->getPage() * $sales->perPage());
    }

    public function searchSales($term){
        $this->search = $term;
    }

    public function delete(Sale $sale)
    {
        $sale->delete();

        return $this->redirectRoute('sales.index', navigate: true);
    }
}
