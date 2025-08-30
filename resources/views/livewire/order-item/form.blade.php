<div class="space-y-6">
    
    <div>
        <x-input-label for="order_id" :value="__('Order Id')"/>
        <x-text-input wire:model="form.order_id" id="order_id" name="order_id" type="text" class="mt-1 block w-full" autocomplete="order_id" placeholder="Order Id"/>
        @error('form.order_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="product_detail_id" :value="__('Product Detail Id')"/>
        <x-text-input wire:model="form.product_detail_id" id="product_detail_id" name="product_detail_id" type="text" class="mt-1 block w-full" autocomplete="product_detail_id" placeholder="Product Detail Id"/>
        @error('form.product_detail_id')
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
        <x-input-label for="price" :value="__('Price')"/>
        <x-text-input wire:model="form.price" id="price" name="price" type="text" class="mt-1 block w-full" autocomplete="price" placeholder="Price"/>
        @error('form.price')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="tax" :value="__('Tax')"/>
        <x-text-input wire:model="form.tax" id="tax" name="tax" type="text" class="mt-1 block w-full" autocomplete="tax" placeholder="Tax"/>
        @error('form.tax')
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
    <div>
        <x-input-label for="item_note" :value="__('Item Note')"/>
        <x-text-input wire:model="form.item_note" id="item_note" name="item_note" type="text" class="mt-1 block w-full" autocomplete="item_note" placeholder="Item Note"/>
        @error('form.item_note')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>