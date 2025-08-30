<div class="space-y-6">
    
    <div>
        <x-input-label for="customer_id" :value="__('Customer Id')"/>
        <x-text-input wire:model="form.customer_id" id="customer_id" name="customer_id" type="text" class="mt-1 block w-full" autocomplete="customer_id" placeholder="Customer Id"/>
        @error('form.customer_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="user_order_managed_by" :value="__('User Order Managed By')"/>
        <x-text-input wire:model="form.user_order_managed_by" id="user_order_managed_by" name="user_order_managed_by" type="text" class="mt-1 block w-full" autocomplete="user_order_managed_by" placeholder="User Order Managed By"/>
        @error('form.user_order_managed_by')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="user_order_collected_by" :value="__('User Order Collected By')"/>
        <x-text-input wire:model="form.user_order_collected_by" id="user_order_collected_by" name="user_order_collected_by" type="text" class="mt-1 block w-full" autocomplete="user_order_collected_by" placeholder="User Order Collected By"/>
        @error('form.user_order_collected_by')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="user_order_delivered_by" :value="__('User Order Delivered By')"/>
        <x-text-input wire:model="form.user_order_delivered_by" id="user_order_delivered_by" name="user_order_delivered_by" type="text" class="mt-1 block w-full" autocomplete="user_order_delivered_by" placeholder="User Order Delivered By"/>
        @error('form.user_order_delivered_by')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="payment_method_id" :value="__('Payment Method Id')"/>
        <x-text-input wire:model="form.payment_method_id" id="payment_method_id" name="payment_method_id" type="text" class="mt-1 block w-full" autocomplete="payment_method_id" placeholder="Payment Method Id"/>
        @error('form.payment_method_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="delivery_package_id" :value="__('Delivery Package Id')"/>
        <x-text-input wire:model="form.delivery_package_id" id="delivery_package_id" name="delivery_package_id" type="text" class="mt-1 block w-full" autocomplete="delivery_package_id" placeholder="Delivery Package Id"/>
        @error('form.delivery_package_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="product_total" :value="__('Product Total')"/>
        <x-text-input wire:model="form.product_total" id="product_total" name="product_total" type="text" class="mt-1 block w-full" autocomplete="product_total" placeholder="Product Total"/>
        @error('form.product_total')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="total_tax" :value="__('Total Tax')"/>
        <x-text-input wire:model="form.total_tax" id="total_tax" name="total_tax" type="text" class="mt-1 block w-full" autocomplete="total_tax" placeholder="Total Tax"/>
        @error('form.total_tax')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="delivery_cost" :value="__('Delivery Cost')"/>
        <x-text-input wire:model="form.delivery_cost" id="delivery_cost" name="delivery_cost" type="text" class="mt-1 block w-full" autocomplete="delivery_cost" placeholder="Delivery Cost"/>
        @error('form.delivery_cost')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="total_discount" :value="__('Total Discount')"/>
        <x-text-input wire:model="form.total_discount" id="total_discount" name="total_discount" type="text" class="mt-1 block w-full" autocomplete="total_discount" placeholder="Total Discount"/>
        @error('form.total_discount')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="total_amount" :value="__('Total Amount')"/>
        <x-text-input wire:model="form.total_amount" id="total_amount" name="total_amount" type="text" class="mt-1 block w-full" autocomplete="total_amount" placeholder="Total Amount"/>
        @error('form.total_amount')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="total_amount_paid" :value="__('Total Amount Paid')"/>
        <x-text-input wire:model="form.total_amount_paid" id="total_amount_paid" name="total_amount_paid" type="text" class="mt-1 block w-full" autocomplete="total_amount_paid" placeholder="Total Amount Paid"/>
        @error('form.total_amount_paid')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="notes" :value="__('Notes')"/>
        <x-text-input wire:model="form.notes" id="notes" name="notes" type="text" class="mt-1 block w-full" autocomplete="notes" placeholder="Notes"/>
        @error('form.notes')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="status" :value="__('Status')"/>
        <x-text-input wire:model="form.status" id="status" name="status" type="text" class="mt-1 block w-full" autocomplete="status" placeholder="Status"/>
        @error('form.status')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>