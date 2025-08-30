<div class="space-y-6">
    
    <div>
        <x-input-label for="name_ar" :value="__('Name Ar')"/>
        <x-text-input wire:model="form.name_ar" id="name_ar" name="name_ar" type="text" class="mt-1 block w-full" autocomplete="name_ar" placeholder="Name Ar"/>
        @error('form.name_ar')
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
        <x-input-label for="price" :value="__('Price')"/>
        <x-text-input wire:model="form.price" id="price" name="price" type="text" class="mt-1 block w-full" autocomplete="price" placeholder="Price"/>
        @error('form.price')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="urgent_price" :value="__('Urgent Price')"/>
        <x-text-input wire:model="form.urgent_price" id="urgent_price" name="urgent_price" type="text" class="mt-1 block w-full" autocomplete="urgent_price" placeholder="Urgent Price"/>
        @error('form.urgent_price')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="time_slot" :value="__('Time Slot')"/>
        <x-text-input wire:model="form.time_slot" id="time_slot" name="time_slot" type="text" class="mt-1 block w-full" autocomplete="time_slot" placeholder="Time Slot"/>
        @error('form.time_slot')
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