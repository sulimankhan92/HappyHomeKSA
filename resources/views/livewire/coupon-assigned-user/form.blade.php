<div class="space-y-6">
    
    <div>
        <x-input-label for="coupon_id" :value="__('Coupon Id')"/>
        <x-text-input wire:model="form.coupon_id" id="coupon_id" name="coupon_id" type="text" class="mt-1 block w-full" autocomplete="coupon_id" placeholder="Coupon Id"/>
        @error('form.coupon_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="user_id" :value="__('User Id')"/>
        <x-text-input wire:model="form.user_id" id="user_id" name="user_id" type="text" class="mt-1 block w-full" autocomplete="user_id" placeholder="User Id"/>
        @error('form.user_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="assigned_by_user_id" :value="__('Assigned By User Id')"/>
        <x-text-input wire:model="form.assigned_by_user_id" id="assigned_by_user_id" name="assigned_by_user_id" type="text" class="mt-1 block w-full" autocomplete="assigned_by_user_id" placeholder="Assigned By User Id"/>
        @error('form.assigned_by_user_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="used_count" :value="__('Used Count')"/>
        <x-text-input wire:model="form.used_count" id="used_count" name="used_count" type="text" class="mt-1 block w-full" autocomplete="used_count" placeholder="Used Count"/>
        @error('form.used_count')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="is_active" :value="__('Is Active')"/>
        <x-text-input wire:model="form.is_active" id="is_active" name="is_active" type="text" class="mt-1 block w-full" autocomplete="is_active" placeholder="Is Active"/>
        @error('form.is_active')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>