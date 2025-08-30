<div class="space-y-6">
    
    <div>
        <x-input-label for="product_id" :value="__('Product Id')"/>
        <x-text-input wire:model="form.product_id" id="product_id" name="product_id" type="text" class="mt-1 block w-full" autocomplete="product_id" placeholder="Product Id"/>
        @error('form.product_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="file_name" :value="__('File Name')"/>
        <x-text-input wire:model="form.file_name" id="file_name" name="file_name" type="text" class="mt-1 block w-full" autocomplete="file_name" placeholder="File Name"/>
        @error('form.file_name')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="order" :value="__('Order')"/>
        <x-text-input wire:model="form.order" id="order" name="order" type="text" class="mt-1 block w-full" autocomplete="order" placeholder="Order"/>
        @error('form.order')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="display_status" :value="__('Display Status')"/>
        <x-text-input wire:model="form.display_status" id="display_status" name="display_status" type="text" class="mt-1 block w-full" autocomplete="display_status" placeholder="Display Status"/>
        @error('form.display_status')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>