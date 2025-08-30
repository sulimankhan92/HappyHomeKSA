<div class="space-y-6">
    
    <div>
        <x-input-label for="secondary_category_id" :value="__('Secondary Category Id')"/>
        <x-text-input wire:model="form.secondary_category_id" id="secondary_category_id" name="secondary_category_id" type="text" class="mt-1 block w-full" autocomplete="secondary_category_id" placeholder="Secondary Category Id"/>
        @error('form.secondary_category_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="images" :value="__('Images')"/>
        <x-text-input wire:model="form.images" id="images" name="images" type="text" class="mt-1 block w-full" autocomplete="images" placeholder="Images"/>
        @error('form.images')
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