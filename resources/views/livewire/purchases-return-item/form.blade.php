<div class="space-y-6">
    
    <div>
        <x-input-label for="purchases_return_id" :value="__('Purchases Return Id')"/>
        <x-text-input wire:model="form.purchases_return_id" id="purchases_return_id" name="purchases_return_id" type="text" class="mt-1 block w-full" autocomplete="purchases_return_id" placeholder="Purchases Return Id"/>
        @error('form.purchases_return_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="product_variant_id" :value="__('Product Variant Id')"/>
        <x-text-input wire:model="form.product_variant_id" id="product_variant_id" name="product_variant_id" type="text" class="mt-1 block w-full" autocomplete="product_variant_id" placeholder="Product Variant Id"/>
        @error('form.product_variant_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="quantity" :value="__('Quantity')"/>
        <x-text-input wire:model="form.quantity" id="quantity" name="quantity" type="text" class="mt-1 block w-full" autocomplete="quantity" placeholder="Quantity"/>
        @error('form.quantity')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="unit_price" :value="__('Unit Price')"/>
        <x-text-input wire:model="form.unit_price" id="unit_price" name="unit_price" type="text" class="mt-1 block w-full" autocomplete="unit_price" placeholder="Unit Price"/>
        @error('form.unit_price')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="expiry_date" :value="__('Expiry Date')"/>
        <x-text-input wire:model="form.expiry_date" id="expiry_date" name="expiry_date" type="text" class="mt-1 block w-full" autocomplete="expiry_date" placeholder="Expiry Date"/>
        @error('form.expiry_date')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="purchase_price" :value="__('Purchase Price')"/>
        <x-text-input wire:model="form.purchase_price" id="purchase_price" name="purchase_price" type="text" class="mt-1 block w-full" autocomplete="purchase_price" placeholder="Purchase Price"/>
        @error('form.purchase_price')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="sale_price" :value="__('Sale Price')"/>
        <x-text-input wire:model="form.sale_price" id="sale_price" name="sale_price" type="text" class="mt-1 block w-full" autocomplete="sale_price" placeholder="Sale Price"/>
        @error('form.sale_price')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="item_total" :value="__('Item Total')"/>
        <x-text-input wire:model="form.item_total" id="item_total" name="item_total" type="text" class="mt-1 block w-full" autocomplete="item_total" placeholder="Item Total"/>
        @error('form.item_total')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="old_qty" :value="__('Old Qty')"/>
        <x-text-input wire:model="form.old_qty" id="old_qty" name="old_qty" type="text" class="mt-1 block w-full" autocomplete="old_qty" placeholder="Old Qty"/>
        @error('form.old_qty')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="old_expiry_date" :value="__('Old Expiry Date')"/>
        <x-text-input wire:model="form.old_expiry_date" id="old_expiry_date" name="old_expiry_date" type="text" class="mt-1 block w-full" autocomplete="old_expiry_date" placeholder="Old Expiry Date"/>
        @error('form.old_expiry_date')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="old_expiry_status" :value="__('Old Expiry Status')"/>
        <x-text-input wire:model="form.old_expiry_status" id="old_expiry_status" name="old_expiry_status" type="text" class="mt-1 block w-full" autocomplete="old_expiry_status" placeholder="Old Expiry Status"/>
        @error('form.old_expiry_status')
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