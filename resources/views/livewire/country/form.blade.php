<div class="space-y-6">
    
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
        <x-input-label for="iso_code" :value="__('Iso Code')"/>
        <x-text-input wire:model="form.iso_code" id="iso_code" name="iso_code" type="text" class="mt-1 block w-full" autocomplete="iso_code" placeholder="Iso Code"/>
        @error('form.iso_code')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="phone_code" :value="__('Phone Code')"/>
        <x-text-input wire:model="form.phone_code" id="phone_code" name="phone_code" type="text" class="mt-1 block w-full" autocomplete="phone_code" placeholder="Phone Code"/>
        @error('form.phone_code')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="currency" :value="__('Currency')"/>
        <x-text-input wire:model="form.currency" id="currency" name="currency" type="text" class="mt-1 block w-full" autocomplete="currency" placeholder="Currency"/>
        @error('form.currency')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>