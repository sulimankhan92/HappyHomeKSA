<?php

namespace App\Livewire\PurchaseItems;

use App\Models\PurchaseItem;
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
        $purchaseItems = PurchaseItem::paginate();

        return view('livewire.purchase-item.index', compact('purchaseItems'))
            ->with('i', $this->getPage() * $purchaseItems->perPage());
    }

    public function delete(PurchaseItem $purchaseItem)
    {
        $purchaseItem->delete();

        return $this->redirectRoute('purchase-items.index', navigate: true);
    }
}
