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
        <x-input-label for="canceled_quantity" :value="__('Canceled Quantity')"/>
        <x-text-input wire:model="form.canceled_quantity" id="canceled_quantity" name="canceled_quantity" type="text" class="mt-1 block w-full" autocomplete="canceled_quantity" placeholder="Canceled Quantity"/>
        @error('form.canceled_quantity')
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
        <x-input-label for="cancellation_reason" :value="__('Cancellation Reason')"/>
        <x-text-input wire:model="form.cancellation_reason" id="cancellation_reason" name="cancellation_reason" type="text" class="mt-1 block w-full" autocomplete="cancellation_reason" placeholder="Cancellation Reason"/>
        @error('form.cancellation_reason')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>