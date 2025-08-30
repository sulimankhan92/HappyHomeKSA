<div class="space-y-6">
    
    <div>
        <x-input-label for="product_details_id" :value="__('Product Details Id')"/>
        <x-text-input wire:model="form.product_details_id" id="product_details_id" name="product_details_id" type="text" class="mt-1 block w-full" autocomplete="product_details_id" placeholder="Product Details Id"/>
        @error('form.product_details_id')
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
        <x-input-label for="promotion_price" :value="__('Promotion Price')"/>
        <x-text-input wire:model="form.promotion_price" id="promotion_price" name="promotion_price" type="text" class="mt-1 block w-full" autocomplete="promotion_price" placeholder="Promotion Price"/>
        @error('form.promotion_price')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="starting_date" :value="__('Starting Date')"/>
        <x-text-input wire:model="form.starting_date" id="starting_date" name="starting_date" type="text" class="mt-1 block w-full" autocomplete="starting_date" placeholder="Starting Date"/>
        @error('form.starting_date')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="last_date" :value="__('Last Date')"/>
        <x-text-input wire:model="form.last_date" id="last_date" name="last_date" type="text" class="mt-1 block w-full" autocomplete="last_date" placeholder="Last Date"/>
        @error('form.last_date')
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