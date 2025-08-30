<?php

namespace App\Livewire\Wallets;

use App\Livewire\Forms\WalletForm;
use App\Models\Wallet;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public WalletForm $form;

    public function mount(Wallet $wallet)
    {
        $this->form->setWalletModel($wallet);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('wallets.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.wallet.edit');
    }
}
