<?php

namespace App\Livewire\Wallets;

use App\Livewire\Forms\WalletForm;
use App\Models\Wallet;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public WalletForm $form;

    public function mount(Wallet $wallet)
    {
        $this->form->setWalletModel($wallet);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.wallet.show', ['wallet' => $this->form->walletModel]);
    }
}
