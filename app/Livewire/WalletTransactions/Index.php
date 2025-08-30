<?php

namespace App\Livewire\WalletTransactions;

use App\Models\WalletTransaction;
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
        $walletTransactions = WalletTransaction::search($this->search)->paginate();

        return view('livewire.wallet-transaction.index', compact('walletTransactions'))
            ->with('i', $this->getPage() * $walletTransactions->perPage());
    }

    public function searchWalletTransactions($term)
    {
        $this->search = $term;
    }

    public function delete(WalletTransaction $walletTransaction)
    {
        $walletTransaction->delete();

        return $this->redirectRoute('wallet-transactions.index', navigate: true);
    }
}
