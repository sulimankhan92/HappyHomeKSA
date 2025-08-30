<div class="space-y-6">
    
    <div>
        <x-input-label for="customer_id" :value="__('Customer Id')"/>
        <x-text-input wire:model="form.customer_id" id="customer_id" name="customer_id" type="text" class="mt-1 block w-full" autocomplete="customer_id" placeholder="Customer Id"/>
        @error('form.customer_id')
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
        <x-input-label for="sale_date" :value="__('Sale Date')"/>
        <x-text-input wire:model="form.sale_date" id="sale_date" name="sale_date" type="text" class="mt-1 block w-full" autocomplete="sale_date" placeholder="Sale Date"/>
        @error('form.sale_date')
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