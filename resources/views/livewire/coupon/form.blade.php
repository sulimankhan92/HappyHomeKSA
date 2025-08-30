<div class="space-y-6">
    
    <div>
        <x-input-label for="created_by" :value="__('Created By')"/>
        <x-text-input wire:model="form.created_by" id="created_by" name="created_by" type="text" class="mt-1 block w-full" autocomplete="created_by" placeholder="Created By"/>
        @error('form.created_by')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="code" :value="__('Code')"/>
        <x-text-input wire:model="form.code" id="code" name="code" type="text" class="mt-1 block w-full" autocomplete="code" placeholder="Code"/>
        @error('form.code')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="title_en" :value="__('Title En')"/>
        <x-text-input wire:model="form.title_en" id="title_en" name="title_en" type="text" class="mt-1 block w-full" autocomplete="title_en" placeholder="Title En"/>
        @error('form.title_en')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="title_ar" :value="__('Title Ar')"/>
        <x-text-input wire:model="form.title_ar" id="title_ar" name="title_ar" type="text" class="mt-1 block w-full" autocomplete="title_ar" placeholder="Title Ar"/>
        @error('form.title_ar')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="description_en" :value="__('Description En')"/>
        <x-text-input wire:model="form.description_en" id="description_en" name="description_en" type="text" class="mt-1 block w-full" autocomplete="description_en" placeholder="Description En"/>
        @error('form.description_en')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="description_ar" :value="__('Description Ar')"/>
        <x-text-input wire:model="form.description_ar" id="description_ar" name="description_ar" type="text" class="mt-1 block w-full" autocomplete="description_ar" placeholder="Description Ar"/>
        @error('form.description_ar')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="coupon_use_counts" :value="__('Coupon Use Counts')"/>
        <x-text-input wire:model="form.coupon_use_counts" id="coupon_use_counts" name="coupon_use_counts" type="text" class="mt-1 block w-full" autocomplete="coupon_use_counts" placeholder="Coupon Use Counts"/>
        @error('form.coupon_use_counts')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="coupon_category" :value="__('Coupon Category')"/>
        <x-text-input wire:model="form.coupon_category" id="coupon_category" name="coupon_category" type="text" class="mt-1 block w-full" autocomplete="coupon_category" placeholder="Coupon Category"/>
        @error('form.coupon_category')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="type" :value="__('Type')"/>
        <x-text-input wire:model="form.type" id="type" name="type" type="text" class="mt-1 block w-full" autocomplete="type" placeholder="Type"/>
        @error('form.type')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="is_for_all_users" :value="__('Is For All Users')"/>
        <x-text-input wire:model="form.is_for_all_users" id="is_for_all_users" name="is_for_all_users" type="text" class="mt-1 block w-full" autocomplete="is_for_all_users" placeholder="Is For All Users"/>
        @error('form.is_for_all_users')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="minimum_order_amount" :value="__('Minimum Order Amount')"/>
        <x-text-input wire:model="form.minimum_order_amount" id="minimum_order_amount" name="minimum_order_amount" type="text" class="mt-1 block w-full" autocomplete="minimum_order_amount" placeholder="Minimum Order Amount"/>
        @error('form.minimum_order_amount')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="amount" :value="__('Amount')"/>
        <x-text-input wire:model="form.amount" id="amount" name="amount" type="text" class="mt-1 block w-full" autocomplete="amount" placeholder="Amount"/>
        @error('form.amount')
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
    <div>
        <x-input-label for="start_date" :value="__('Start Date')"/>
        <x-text-input wire:model="form.start_date" id="start_date" name="start_date" type="text" class="mt-1 block w-full" autocomplete="start_date" placeholder="Start Date"/>
        @error('form.start_date')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="end_date" :value="__('End Date')"/>
        <x-text-input wire:model="form.end_date" id="end_date" name="end_date" type="text" class="mt-1 block w-full" autocomplete="end_date" placeholder="End Date"/>
        @error('form.end_date')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>