<div class="space-y-6">
    
    <div>
        <x-input-label for="product_variant_id" :value="__('Product Variant Id')"/>
        <x-text-input wire:model="form.product_variant_id" id="product_variant_id" name="product_variant_id" type="text" class="mt-1 block w-full" autocomplete="product_variant_id" placeholder="Product Variant Id"/>
        @error('form.product_variant_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="product_packaging_id" :value="__('Product Packaging Id')"/>
        <x-text-input wire:model="form.product_packaging_id" id="product_packaging_id" name="product_packaging_id" type="text" class="mt-1 block w-full" autocomplete="product_packaging_id" placeholder="Product Packaging Id"/>
        @error('form.product_packaging_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="created_by" :value="__('Created By')"/>
        <x-text-input wire:model="form.created_by" id="created_by" name="created_by" type="text" class="mt-1 block w-full" autocomplete="created_by" placeholder="Created By"/>
        @error('form.created_by')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="price" :value="__('Price')"/>
        <x-text-input wire:model="form.price" id="price" name="price" type="text" class="mt-1 block w-full" autocomplete="price" placeholder="Price"/>
        @error('form.price')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="quantity_to_show_alerts" :value="__('Quantity To Show Alerts')"/>
        <x-text-input wire:model="form.quantity_to_show_alerts" id="quantity_to_show_alerts" name="quantity_to_show_alerts" type="text" class="mt-1 block w-full" autocomplete="quantity_to_show_alerts" placeholder="Quantity To Show Alerts"/>
        @error('form.quantity_to_show_alerts')
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