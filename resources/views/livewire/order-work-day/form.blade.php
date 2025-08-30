<div class="space-y-6">
    <div>
        <x-input-label for="day" :value="__('Day')"/>
        <x-text-input wire:model="form.day" id="day" name="day" type="text" class="mt-1 block w-full" autocomplete="day" placeholder="Day"/>
        @error('form.day')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="is_work_day" :value="__('Is Work Day')"/>
        <x-text-input wire:model="form.is_work_day" id="is_work_day" name="is_work_day" type="text" class="mt-1 block w-full" autocomplete="is_work_day" placeholder="Is Work Day"/>
        @error('form.is_work_day')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>
