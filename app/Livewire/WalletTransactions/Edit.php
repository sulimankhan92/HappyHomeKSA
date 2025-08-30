<?php

namespace App\Livewire\WalletTransactions;

use App\Livewire\Forms\WalletTransactionForm;
use App\Models\WalletTransaction;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public WalletTransactionForm $form;

    public function mount(WalletTransaction $walletTransaction)
    {
        $this->form->setWalletTransactionModel($walletTransaction);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('wallet-transactions.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.wallet-transaction.edit');
    }
}
