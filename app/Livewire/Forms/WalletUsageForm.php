<?php

namespace App\Livewire\Forms;

use App\Models\WalletUsage;
use Livewire\Form;

class WalletUsageForm extends Form
{
    public ?WalletUsage $walletUsageModel;
    
    public $wallet_id = '';
    public $wallet_transaction_id = '';
    public $user_id = '';
    public $order_id = '';
    public $amount_used = '';

    public function rules(): array
    {
        return [
			'amount_used' => 'required',
        ];
    }

    public function setWalletUsageModel(WalletUsage $walletUsageModel): void
    {
        $this->walletUsageModel = $walletUsageModel;
        
        $this->wallet_id = $this->walletUsageModel->wallet_id;
        $this->wallet_transaction_id = $this->walletUsageModel->wallet_transaction_id;
        $this->user_id = $this->walletUsageModel->user_id;
        $this->order_id = $this->walletUsageModel->order_id;
        $this->amount_used = $this->walletUsageModel->amount_used;
    }

    public function store(): void
    {
        $this->walletUsageModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->walletUsageModel->update($this->validate());

        $this->reset();
    }
}
