<?php

namespace App\Livewire\PurchasesReturns;

use App\Models\PurchasesReturn;
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
        $purchasesReturns = PurchasesReturn::paginate();

        return view('livewire.purchases-return.index', compact('purchasesReturns'))
            ->with('i', $this->getPage() * $purchasesReturns->perPage());
    }

    public function delete(PurchasesReturn $purchasesReturn)
    {
        $purchasesReturn->delete();

        return $this->redirectRoute('purchases-returns.index', navigate: true);
    }
}
