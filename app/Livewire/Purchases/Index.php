<?php

namespace App\Livewire\Purchases;

use App\Models\Purchase;
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
        $purchases = Purchase::search($this->search)->with('supplier','user')->orderBy('created_at', 'desc')->paginate();

        return view('livewire.purchase.index', compact('purchases'))
            ->with('i', $this->getPage() * $purchases->perPage());
    }

    public function searchPurchases($term){
        $this->search = $term;
    }

    public function delete(Purchase $purchase)
    {
        $purchase->delete();

        return $this->redirectRoute('purchases.index', navigate: true);
    }
}
