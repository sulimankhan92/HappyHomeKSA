<div class="space-y-6">
    
    <div>
        <x-input-label for="product_id" :value="__('Product Id')"/>
        <x-text-input wire:model="form.product_id" id="product_id" name="product_id" type="text" class="mt-1 block w-full" autocomplete="product_id" placeholder="Product Id"/>
        @error('form.product_id')
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
        <x-input-label for="unit_id" :value="__('Unit Id')"/>
        <x-text-input wire:model="form.unit_id" id="unit_id" name="unit_id" type="text" class="mt-1 block w-full" autocomplete="unit_id" placeholder="Unit Id"/>
        @error('form.unit_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="weight" :value="__('Weight')"/>
        <x-text-input wire:model="form.weight" id="weight" name="weight" type="text" class="mt-1 block w-full" autocomplete="weight" placeholder="Weight"/>
        @error('form.weight')
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
        <x-input-label for="expiry_date" :value="__('Expiry Date')"/>
        <x-text-input wire:model="form.expiry_date" id="expiry_date" name="expiry_date" type="text" class="mt-1 block w-full" autocomplete="expiry_date" placeholder="Expiry Date"/>
        @error('form.expiry_date')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="expiry_date_alerts" :value="__('Expiry Date Alerts')"/>
        <x-text-input wire:model="form.expiry_date_alerts" id="expiry_date_alerts" name="expiry_date_alerts" type="text" class="mt-1 block w-full" autocomplete="expiry_date_alerts" placeholder="Expiry Date Alerts"/>
        @error('form.expiry_date_alerts')
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