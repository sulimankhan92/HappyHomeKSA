<?php

namespace App\Livewire\Forms;

use App\Models\Wallet;
use Livewire\Form;

class WalletForm extends Form
{
    public ?Wallet $walletModel;
    
    public $user_id = '';
    public $name = '';
    public $balance = '';
    public $status = '';

    public function rules(): array
    {
        return [
			'name' => 'string',
			'balance' => 'required',
			'status' => 'required',
        ];
    }

    public function setWalletModel(Wallet $walletModel): void
    {
        $this->walletModel = $walletModel;
        
        $this->user_id = $this->walletModel->user_id;
        $this->name = $this->walletModel->name;
        $this->balance = $this->walletModel->balance;
        $this->status = $this->walletModel->status;
    }

    public function store(): void
    {
        $this->walletModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->walletModel->update($this->validate());

        $this->reset();
    }
}
