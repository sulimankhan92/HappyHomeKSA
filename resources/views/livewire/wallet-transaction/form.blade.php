<div class="space-y-6">
    
    <div>
        <x-input-label for="wallet_id" :value="__('Wallet Id')"/>
        <x-text-input wire:model="form.wallet_id" id="wallet_id" name="wallet_id" type="text" class="mt-1 block w-full" autocomplete="wallet_id" placeholder="Wallet Id"/>
        @error('form.wallet_id')
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
        <x-input-label for="type" :value="__('Type')"/>
        <x-text-input wire:model="form.type" id="type" name="type" type="text" class="mt-1 block w-full" autocomplete="type" placeholder="Type"/>
        @error('form.type')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="amount" :value="__('Amount')"/>
        <x-text-input wire:model="form.amount" id="amount" name="amount" type="text" class="mt-1 block w-full" autocomplete="amount" placeholder="Amount"/>
        @error('form.amount')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="credit" :value="__('Credit')"/>
        <x-text-input wire:model="form.credit" id="credit" name="credit" type="text" class="mt-1 block w-full" autocomplete="credit" placeholder="Credit"/>
        @error('form.credit')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="debit" :value="__('Debit')"/>
        <x-text-input wire:model="form.debit" id="debit" name="debit" type="text" class="mt-1 block w-full" autocomplete="debit" placeholder="Debit"/>
        @error('form.debit')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="description" :value="__('Description')"/>
        <x-text-input wire:model="form.description" id="description" name="description" type="text" class="mt-1 block w-full" autocomplete="description" placeholder="Description"/>
        @error('form.description')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>