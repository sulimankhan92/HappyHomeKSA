<?php

namespace App\Livewire\WalletUsages;

use App\Livewire\Forms\WalletUsageForm;
use App\Models\WalletUsage;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public WalletUsageForm $form;

    public function mount(WalletUsage $walletUsage)
    {
        $this->form->setWalletUsageModel($walletUsage);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.wallet-usage.show', ['walletUsage' => $this->form->walletUsageModel]);
    }
}
