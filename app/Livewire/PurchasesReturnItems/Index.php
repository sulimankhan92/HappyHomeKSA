<?php

namespace App\Livewire\PurchasesReturnItems;

use App\Models\PurchasesReturnItem;
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
        $purchasesReturnItems = PurchasesReturnItem::paginate();

        return view('livewire.purchases-return-item.index', compact('purchasesReturnItems'))
            ->with('i', $this->getPage() * $purchasesReturnItems->perPage());
    }

    public function delete(PurchasesReturnItem $purchasesReturnItem)
    {
        $purchasesReturnItem->delete();

        return $this->redirectRoute('purchases-return-items.index', navigate: true);
    }
}
