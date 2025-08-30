<?php

namespace App\Livewire\Forms;

use App\Models\WalletTransaction;
use Livewire\Form;

class WalletTransactionForm extends Form
{
    public ?WalletTransaction $walletTransactionModel;
    
    public $wallet_id = '';
    public $user_id = '';
    public $type = '';
    public $amount = '';
    public $credit = '';
    public $debit = '';
    public $description = '';

    public function rules(): array
    {
        return [
			'type' => 'required|string',
			'amount' => 'required',
			'credit' => 'required',
			'debit' => 'required',
			'description' => 'string',
        ];
    }

    public function setWalletTransactionModel(WalletTransaction $walletTransactionModel): void
    {
        $this->walletTransactionModel = $walletTransactionModel;
        
        $this->wallet_id = $this->walletTransactionModel->wallet_id;
        $this->user_id = $this->walletTransactionModel->user_id;
        $this->type = $this->walletTransactionModel->type;
        $this->amount = $this->walletTransactionModel->amount;
        $this->credit = $this->walletTransactionModel->credit;
        $this->debit = $this->walletTransactionModel->debit;
        $this->description = $this->walletTransactionModel->description;
    }

    public function store(): void
    {
        $this->walletTransactionModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->walletTransactionModel->update($this->validate());

        $this->reset();
    }
}
