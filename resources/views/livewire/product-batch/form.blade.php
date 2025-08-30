<div class="space-y-6">
    
    <div>
        <x-input-label for="product_variant_id" :value="__('Product Variant Id')"/>
        <x-text-input wire:model="form.product_variant_id" id="product_variant_id" name="product_variant_id" type="text" class="mt-1 block w-full" autocomplete="product_variant_id" placeholder="Product Variant Id"/>
        @error('form.product_variant_id')
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
        <x-input-label for="batch_no" :value="__('Batch No')"/>
        <x-text-input wire:model="form.batch_no" id="batch_no" name="batch_no" type="text" class="mt-1 block w-full" autocomplete="batch_no" placeholder="Batch No"/>
        @error('form.batch_no')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="qty" :value="__('Qty')"/>
        <x-text-input wire:model="form.qty" id="qty" name="qty" type="text" class="mt-1 block w-full" autocomplete="qty" placeholder="Qty"/>
        @error('form.qty')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="expired_date" :value="__('Expired Date')"/>
        <x-text-input wire:model="form.expired_date" id="expired_date" name="expired_date" type="text" class="mt-1 block w-full" autocomplete="expired_date" placeholder="Expired Date"/>
        @error('form.expired_date')
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