<div class="space-y-6">
    
    <div>
        <x-input-label for="purchase_id" :value="__('Purchase Id')"/>
        <x-text-input wire:model="form.purchase_id" id="purchase_id" name="purchase_id" type="text" class="mt-1 block w-full" autocomplete="purchase_id" placeholder="Purchase Id"/>
        @error('form.purchase_id')
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

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>