<?php

namespace App\Livewire\WalletUsages;

use App\Livewire\Forms\WalletUsageForm;
use App\Models\WalletUsage;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public WalletUsageForm $form;

    public function mount(WalletUsage $walletUsage)
    {
        $this->form->setWalletUsageModel($walletUsage);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('wallet-usages.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.wallet-usage.edit');
    }
}
