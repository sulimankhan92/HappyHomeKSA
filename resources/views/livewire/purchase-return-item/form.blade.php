<div class="space-y-6">
    
    <div>
        <x-input-label for="purchase_return_id" :value="__('Purchase Return Id')"/>
        <x-text-input wire:model="form.purchase_return_id" id="purchase_return_id" name="purchase_return_id" type="text" class="mt-1 block w-full" autocomplete="purchase_return_id" placeholder="Purchase Return Id"/>
        @error('form.purchase_return_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="purchase_item_id" :value="__('Purchase Item Id')"/>
        <x-text-input wire:model="form.purchase_item_id" id="purchase_item_id" name="purchase_item_id" type="text" class="mt-1 block w-full" autocomplete="purchase_item_id" placeholder="Purchase Item Id"/>
        @error('form.purchase_item_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="quantity_returned" :value="__('Quantity Returned')"/>
        <x-text-input wire:model="form.quantity_returned" id="quantity_returned" name="quantity_returned" type="text" class="mt-1 block w-full" autocomplete="quantity_returned" placeholder="Quantity Returned"/>
        @error('form.quantity_returned')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="reason_for_return" :value="__('Reason For Return')"/>
        <x-text-input wire:model="form.reason_for_return" id="reason_for_return" name="reason_for_return" type="text" class="mt-1 block w-full" autocomplete="reason_for_return" placeholder="Reason For Return"/>
        @error('form.reason_for_return')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="refund_amount" :value="__('Refund Amount')"/>
        <x-text-input wire:model="form.refund_amount" id="refund_amount" name="refund_amount" type="text" class="mt-1 block w-full" autocomplete="refund_amount" placeholder="Refund Amount"/>
        @error('form.refund_amount')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>