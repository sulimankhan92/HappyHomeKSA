<div class="space-y-6">
    
    <div>
        <x-input-label for="wallet_id" :value="__('Wallet Id')"/>
        <x-text-input wire:model="form.wallet_id" id="wallet_id" name="wallet_id" type="text" class="mt-1 block w-full" autocomplete="wallet_id" placeholder="Wallet Id"/>
        @error('form.wallet_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="wallet_transaction_id" :value="__('Wallet Transaction Id')"/>
        <x-text-input wire:model="form.wallet_transaction_id" id="wallet_transaction_id" name="wallet_transaction_id" type="text" class="mt-1 block w-full" autocomplete="wallet_transaction_id" placeholder="Wallet Transaction Id"/>
        @error('form.wallet_transaction_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="user_id" :value="__('User Id')"/>
        <x-text-input wire:model="form.user_id" id="user_id" name="user_id" type="text" class="mt-1 block w-full" autocomplete="user_id" placeholder="User Id"/>
        @error('form.user_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="order_id" :value="__('Order Id')"/>
        <x-text-input wire:model="form.order_id" id="order_id" name="order_id" type="text" class="mt-1 block w-full" autocomplete="order_id" placeholder="Order Id"/>
        @error('form.order_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="amount_used" :value="__('Amount Used')"/>
        <x-text-input wire:model="form.amount_used" id="amount_used" name="amount_used" type="text" class="mt-1 block w-full" autocomplete="amount_used" placeholder="Amount Used"/>
        @error('form.amount_used')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>