<div class="space-y-6">
    
    <div>
        <x-input-label for="user_id" :value="__('User Id')"/>
        <x-text-input wire:model="form.user_id" id="user_id" name="user_id" type="text" class="mt-1 block w-full" autocomplete="user_id" placeholder="User Id"/>
        @error('form.user_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="ticket_process_by" :value="__('Ticket Process By')"/>
        <x-text-input wire:model="form.ticket_process_by" id="ticket_process_by" name="ticket_process_by" type="text" class="mt-1 block w-full" autocomplete="ticket_process_by" placeholder="Ticket Process By"/>
        @error('form.ticket_process_by')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="subject" :value="__('Subject')"/>
        <x-text-input wire:model="form.subject" id="subject" name="subject" type="text" class="mt-1 block w-full" autocomplete="subject" placeholder="Subject"/>
        @error('form.subject')
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