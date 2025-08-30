<div class="space-y-6">
    
    <div>
        <x-input-label for="purchase_id" :value="__('Purchase Id')"/>
        <x-text-input wire:model="form.purchase_id" id="purchase_id" name="purchase_id" type="text" class="mt-1 block w-full" autocomplete="purchase_id" placeholder="Purchase Id"/>
        @error('form.purchase_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="return_date" :value="__('Return Date')"/>
        <x-text-input wire:model="form.return_date" id="return_date" name="return_date" type="text" class="mt-1 block w-full" autocomplete="return_date" placeholder="Return Date"/>
        @error('form.return_date')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="reason" :value="__('Reason')"/>
        <x-text-input wire:model="form.reason" id="reason" name="reason" type="text" class="mt-1 block w-full" autocomplete="reason" placeholder="Reason"/>
        @error('form.reason')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="total_refunded" :value="__('Total Refunded')"/>
        <x-text-input wire:model="form.total_refunded" id="total_refunded" name="total_refunded" type="text" class="mt-1 block w-full" autocomplete="total_refunded" placeholder="Total Refunded"/>
        @error('form.total_refunded')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>