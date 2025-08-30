<div class="space-y-6">
    <x-text-input wire:model="form.order_work_day_id"  id="order_work_day_id" name="order_work_day_id" type="text" class="form-control" autocomplete="order_work_day_id" placeholder="Day"/>

    <div>
        <x-input-label for="time_slot" :value="__('Time Slot')"/>
        <x-text-input wire:model="form.time_slot" id="time_slot" name="time_slot" type="text" class="form-control" autocomplete="time_slot" placeholder="Time Slot 12:00 - 02:00"/>
        @error('form.time_slot')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="urgent_basis" :value="__('Urgent Basis')"/>
        <x-text-input wire:model="form.urgent_basis" id="urgent_basis" name="urgent_basis" type="text" class="form-control" autocomplete="urgent_basis" placeholder="Urgent Basis"/>
        @error('form.urgent_basis')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>


</div>
