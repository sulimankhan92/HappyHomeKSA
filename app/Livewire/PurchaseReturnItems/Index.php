<?php

namespace App\Livewire\PurchaseReturnItems;

use App\Models\PurchaseReturnItem;
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
        $purchaseReturnItems = PurchaseReturnItem::paginate();

        return view('livewire.purchase-return-item.index', compact('purchaseReturnItems'))
            ->with('i', $this->getPage() * $purchaseReturnItems->perPage());
    }

    public function delete(PurchaseReturnItem $purchaseReturnItem)
    {
        $purchaseReturnItem->delete();

        return $this->redirectRoute('purchase-return-items.index', navigate: true);
    }

}
