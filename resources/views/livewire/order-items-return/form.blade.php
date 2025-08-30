<div class="space-y-6">
    
    <div>
        <x-input-label for="order_id" :value="__('Order Id')"/>
        <x-text-input wire:model="form.order_id" id="order_id" name="order_id" type="text" class="mt-1 block w-full" autocomplete="order_id" placeholder="Order Id"/>
        @error('form.order_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="order_item_id" :value="__('Order Item Id')"/>
        <x-text-input wire:model="form.order_item_id" id="order_item_id" name="order_item_id" type="text" class="mt-1 block w-full" autocomplete="order_item_id" placeholder="Order Item Id"/>
        @error('form.order_item_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="return_quantity" :value="__('Return Quantity')"/>
        <x-text-input wire:model="form.return_quantity" id="return_quantity" name="return_quantity" type="text" class="mt-1 block w-full" autocomplete="return_quantity" placeholder="Return Quantity"/>
        @error('form.return_quantity')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="reason_subject" :value="__('Reason Subject')"/>
        <x-text-input wire:model="form.reason_subject" id="reason_subject" name="reason_subject" type="text" class="mt-1 block w-full" autocomplete="reason_subject" placeholder="Reason Subject"/>
        @error('form.reason_subject')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="return_reason" :value="__('Return Reason')"/>
        <x-text-input wire:model="form.return_reason" id="return_reason" name="return_reason" type="text" class="mt-1 block w-full" autocomplete="return_reason" placeholder="Return Reason"/>
        @error('form.return_reason')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>