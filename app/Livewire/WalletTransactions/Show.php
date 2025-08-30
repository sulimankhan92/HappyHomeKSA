<?php

namespace App\Livewire\WalletTransactions;

use App\Livewire\Forms\WalletTransactionForm;
use App\Models\WalletTransaction;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public WalletTransactionForm $form;

    public function mount(WalletTransaction $walletTransaction)
    {
        $this->form->setWalletTransactionModel($walletTransaction);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.wallet-transaction.show', ['walletTransaction' => $this->form->walletTransactionModel]);
    }
}
