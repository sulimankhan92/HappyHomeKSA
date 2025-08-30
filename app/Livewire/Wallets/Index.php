<?php

namespace App\Livewire\Wallets;

use App\Models\Wallet;
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
        $wallets = Wallet::search($this->search)->paginate();

        return view('livewire.wallet.index', compact('wallets'))
            ->with('i', $this->getPage() * $wallets->perPage());
    }

    public function searchWallet($term)
    {
        $this->search = $term;
    }

    public function delete(Wallet $wallet)
    {
        $wallet->delete();

        return $this->redirectRoute('wallets.index', navigate: true);
    }
}
