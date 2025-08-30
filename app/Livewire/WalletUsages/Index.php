<?php

namespace App\Livewire\WalletUsages;

use App\Models\WalletUsage;
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
        $walletUsages = WalletUsage::search($this->search)->paginate();

        return view('livewire.wallet-usage.index', compact('walletUsages'))
            ->with('i', $this->getPage() * $walletUsages->perPage());
    }

    public function searchWalletUsage($term)
    {
        $this->search = $term;
    }

    public function delete(WalletUsage $walletUsage)
    {
        $walletUsage->delete();

        return $this->redirectRoute('wallet-usages.index', navigate: true);
    }
}
