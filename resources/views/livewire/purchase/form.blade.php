<div class="space-y-6">
    
    <div>
        <x-input-label for="supplier_id" :value="__('Supplier Id')"/>
        <x-text-input wire:model="form.supplier_id" id="supplier_id" name="supplier_id" type="text" class="mt-1 block w-full" autocomplete="supplier_id" placeholder="Supplier Id"/>
        @error('form.supplier_id')
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
        <x-input-label for="purchase_date" :value="__('Purchase Date')"/>
        <x-text-input wire:model="form.purchase_date" id="purchase_date" name="purchase_date" type="text" class="mt-1 block w-full" autocomplete="purchase_date" placeholder="Purchase Date"/>
        @error('form.purchase_date')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="total_tax" :value="__('Total Tax')"/>
        <x-text-input wire:model="form.total_tax" id="total_tax" name="total_tax" type="text" class="mt-1 block w-full" autocomplete="total_tax" placeholder="Total Tax"/>
        @error('form.total_tax')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="shipping_cost" :value="__('Shipping Cost')"/>
        <x-text-input wire:model="form.shipping_cost" id="shipping_cost" name="shipping_cost" type="text" class="mt-1 block w-full" autocomplete="shipping_cost" placeholder="Shipping Cost"/>
        @error('form.shipping_cost')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="total_discount" :value="__('Total Discount')"/>
        <x-text-input wire:model="form.total_discount" id="total_discount" name="total_discount" type="text" class="mt-1 block w-full" autocomplete="total_discount" placeholder="Total Discount"/>
        @error('form.total_discount')
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
        <x-input-label for="paid_amount" :value="__('Paid Amount')"/>
        <x-text-input wire:model="form.paid_amount" id="paid_amount" name="paid_amount" type="text" class="mt-1 block w-full" autocomplete="paid_amount" placeholder="Paid Amount"/>
        @error('form.paid_amount')
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