<div class="space-y-6">
    
    <div>
        <x-input-label for="user_id" :value="__('User Id')"/>
        <x-text-input wire:model="form.user_id" id="user_id" name="user_id" type="text" class="mt-1 block w-full" autocomplete="user_id" placeholder="User Id"/>
        @error('form.user_id')
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