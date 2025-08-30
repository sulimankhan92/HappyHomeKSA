<?php

namespace App\Livewire\PurchaseReturns;

use App\Models\PurchaseReturn;
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
//        $purchaseReturns = PurchaseReturn::paginate();
//        $purchaseReturns = PurchaseReturn::search($this->search)->with('supplier','user')->orderBy('created_at', 'desc')->paginate();
        $purchaseReturns = PurchaseReturn::search($this->search)->orderBy('created_at', 'desc')->paginate();


        return view('livewire.purchase-return.index', compact('purchaseReturns'))
            ->with('i', $this->getPage() * $purchaseReturns->perPage());
    }

    public function delete(PurchaseReturn $purchaseReturn)
    {
        $purchaseReturn->delete();

        return $this->redirectRoute('purchase-returns.index', navigate: true);
    }

    public function searchPurchasesReturn($term){
            $this->search = $term;
    }
}
