<div class="space-y-6">
    
    <div>
        <x-input-label for="ticket_id" :value="__('Ticket Id')"/>
        <x-text-input wire:model="form.ticket_id" id="ticket_id" name="ticket_id" type="text" class="mt-1 block w-full" autocomplete="ticket_id" placeholder="Ticket Id"/>
        @error('form.ticket_id')
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
        <x-input-label for="message" :value="__('Message')"/>
        <x-text-input wire:model="form.message" id="message" name="message" type="text" class="mt-1 block w-full" autocomplete="message" placeholder="Message"/>
        @error('form.message')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="is_user" :value="__('Is User')"/>
        <x-text-input wire:model="form.is_user" id="is_user" name="is_user" type="text" class="mt-1 block w-full" autocomplete="is_user" placeholder="Is User"/>
        @error('form.is_user')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="language" :value="__('Language')"/>
        <x-text-input wire:model="form.language" id="language" name="language" type="text" class="mt-1 block w-full" autocomplete="language" placeholder="Language"/>
        @error('form.language')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>