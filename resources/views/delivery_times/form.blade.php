<div class="card-body">
    <div class="row">

    <x-text-input type="hidden" id="order_work_day_id" name="order_work_day_id" value="{{ $delivery_time->order_work_day_id }}" class="form-control" autocomplete="order_work_day_id" placeholder="Day"/>

    <div class="col-md-6">
        <x-input-label for="time_slot" :value="__('Time Slot')"/>
        <x-text-input id="time_slot" name="time_slot" type="text" class="form-control" value="{{ $delivery_time->time_slot }}" placeholder="12:00 - 02:00"/>
        @error('form.time_slot')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
        <p id="validationMessage"></p>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <x-input-label for="status" :value="__('Status')"/>
            <select id="status" name="status" class="form-control" autocomplete="status">
                <option value="" disabled>Select Status</option>
                @foreach($delivery_time->getOrderWorkDaysOptions() as $key => $status)
                    <option value="{{ $key }}" {{ old('status', $delivery_time?->status) == $key ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
            @error('form.status')
            <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>
    </div>
    </div>
{{--    <div>--}}
{{--        <x-input-label for="urgent_basis" :value="__('Urgent Basis')"/>--}}
{{--        <x-text-input wire:model="form.urgent_basis" id="urgent_basis" name="urgent_basis" type="text" class="form-control" autocomplete="urgent_basis" placeholder="Urgent Basis"/>--}}
{{--        @error('form.urgent_basis')--}}
{{--            <x-input-error class="mt-2" :messages="$message"/>--}}
{{--        @enderror--}}
{{--    </div>--}}


</div>
{{--<input type="text" placeholder="12:00 - 02:00" />--}}
{{--<button onclick="validateTimeRange()">Validate</button>--}}
{{--<p id="validationMessage"></p>--}}

<script>
    function validateTimeRange() {
        const timeRangeInput = document.getElementById("time_slot").value;
        const validationMessage = document.getElementById("validationMessage");

        // Regular expression for matching time range format HH:mm - HH:mm
        const timeRangeRegex = /^([01]\d|2[0-3]):([0-5]\d) - ([01]\d|2[0-3]):([0-5]\d)$/;

        if (!timeRangeRegex.test(timeRangeInput)) {
            validationMessage.textContent = "Invalid format. Please use 12:00 - 02:00 HH:mm - HH:mm.";
            validationMessage.style.color = "red";
            return false;
        }

        // Extract start and end times
        const [, startHour, startMinute, endHour, endMinute] = timeRangeInput.match(timeRangeRegex);

        // Convert to minutes for comparison
        // const startTimeInMinutes = parseInt(startHour) * 60 + parseInt(startMinute);
        // const endTimeInMinutes = parseInt(endHour) * 60 + parseInt(endMinute);
        //
        // if (startTimeInMinutes >= endTimeInMinutes) {
        //     validationMessage.textContent = "Invalid time range. Start time must be earlier than end time.";
        //     validationMessage.style.color = "red";
        //     return false;
        // }

        // validationMessage.textContent = "Valid time range!";
        // validationMessage.style.color = "green";
        return true;
    }
</script>
