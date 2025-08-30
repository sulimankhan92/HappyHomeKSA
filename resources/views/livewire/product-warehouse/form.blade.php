<div class="space-y-6">
    
    <div>
        <x-input-label for="created_by" :value="__('Created By')"/>
        <x-text-input wire:model="form.created_by" id="created_by" name="created_by" type="text" class="mt-1 block w-full" autocomplete="created_by" placeholder="Created By"/>
        @error('form.created_by')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="name_en" :value="__('Name En')"/>
        <x-text-input wire:model="form.name_en" id="name_en" name="name_en" type="text" class="mt-1 block w-full" autocomplete="name_en" placeholder="Name En"/>
        @error('form.name_en')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="name_ar" :value="__('Name Ar')"/>
        <x-text-input wire:model="form.name_ar" id="name_ar" name="name_ar" type="text" class="mt-1 block w-full" autocomplete="name_ar" placeholder="Name Ar"/>
        @error('form.name_ar')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="address" :value="__('Address')"/>
        <x-text-input wire:model="form.address" id="address" name="address" type="text" class="mt-1 block w-full" autocomplete="address" placeholder="Address"/>
        @error('form.address')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="phone_number" :value="__('Phone Number')"/>
        <x-text-input wire:model="form.phone_number" id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" autocomplete="phone_number" placeholder="Phone Number"/>
        @error('form.phone_number')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="location_link" :value="__('Location Link')"/>
        <x-text-input wire:model="form.location_link" id="location_link" name="location_link" type="text" class="mt-1 block w-full" autocomplete="location_link" placeholder="Location Link"/>
        @error('form.location_link')
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