<div class="space-y-6">
    <div class="row">
{{--        <div class="col-md-4 mt-2">--}}
{{--        <label for="search-prod">Find Customer</label>--}}
{{--        <select id="user_id" class="form-control user_id" name="user_id">--}}
{{--            @if(isset($selectedUser))--}}
{{--                <option value="{{ $selectedUser->id }}" selected>{{ $selectedUser->name }}</option>--}}
{{--            @else--}}
{{--                <option value="">Select Customer</option>--}}
{{--            @endif--}}
{{--        </select>--}}
{{--        @error('user_id')--}}
{{--        <x-input-error class="mt-2" :messages="$message" />--}}
{{--        @enderror--}}
{{--    </div>--}}
    <div class="col-md-4 mt-2">
        <x-input-label for="code" :value="__('Code')"/>
        <x-text-input id="code" name="code" type="text" class="form-control" value="{{ old('code', $coupons->code ?? '') }}"  autocomplete="code" placeholder="Code"/>
        @error('code')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div class="col-md-4 mt-2">
        <x-input-label for="title_en" :value="__('Title En')"/>
        <x-text-input id="title_en" name="title_en" type="text" value="{{ old('title_en', $coupons->title_en ?? '') }}" class="form-control" autocomplete="title_en" placeholder="Title En"/>
        @error('title_en')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div class="col-md-4 mt-2">
        <x-input-label for="title_ar" :value="__('Title Ar')"/>
        <x-text-input id="title_ar" name="title_ar" type="text" class="form-control" value="{{ old('code', $coupons->code ?? '') }}" autocomplete="title_ar" placeholder="Title Ar"/>
        @error('title_ar')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div class="col-md-4 mt-2">
        <x-input-label for="coupon_category" :value="__('Coupon Category')"/>
        <select id="coupon_category" name="coupon_category" class="form-control" autocomplete="coupon_category">
            <option value="" disabled {{ old('coupon_category', $coupons->coupon_category ?? '') === '' ? 'selected' : '' }}>
                {{ __('Select Coupon Category') }}
            </option>
            @foreach($categories as $key => $value)
                <option value="{{ $key }}" {{ old('coupon_category', $coupons->coupon_category ?? '') == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>

        @error('coupon_category')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
{{--    <div class="col-md-4 mt-2">--}}
{{--        <x-input-label for="type" :value="__('Type')"/>--}}
{{--        <select id="type" name="type" class="form-control" autocomplete="type">--}}
{{--            <option value="" disabled {{ old('coupon_category', $coupons->type ?? '') === '' ? 'selected' : '' }}>--}}
{{--                {{ __('Select Coupon Type') }}--}}
{{--            </option>--}}
{{--            @foreach($types as $key => $value)--}}
{{--                <option value="{{ $key }}" {{ old('coupon_category', $coupons->type ?? '') == $key ? 'selected' : '' }}>--}}
{{--                    {{ $value }}--}}
{{--                </option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--        @error('form.type')--}}
{{--        <x-input-error class="mt-2" :messages="$message"/>--}}
{{--        @enderror--}}
{{--    </div>--}}
        <div class="col-md-4 mt-2">
            <x-input-label for="type" :value="__('Type')"/>
            <select id="type" name="type" class="form-control" autocomplete="type">
{{--                <option value="" disabled {{ old('coupon_category', $coupons->type ?? '') === '' ? 'selected' : '' }}>--}}
{{--                    {{ __('Select Coupon Type') }}--}}
{{--                </option>--}}
                @foreach($types as $key => $value)
                    <option value="{{ $key }}" {{ old('coupon_category', $coupons->type ?? '') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
            @error('type')
            <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>
        <div class="col-md-4 mt-2" id="amount-container">
            <x-input-label for="amount" :value="__('Amount')"/>
            <x-text-input id="amount" name="amount" type="number" class="form-control" value="{{ old('amount', $coupons->amount ?? 0 ) }}" autocomplete="amount" placeholder="Amount"/>
            @error('amount')
            <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>

        <div class="col-md-4 mt-2" id="percentage-container" style="display: none;"> <!-- Hide percentage by default -->
            <x-input-label for="percentage" :value="__('Percentage')"/>
            <x-text-input id="percentage" name="percentage" type="number" class="form-control" value="{{ old('percentage', $coupons->percentage ?? 0) }}" autocomplete="percentage" placeholder="Percentage"/>
            @error('percentage')
            <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>
    <div class="col-md-4 mt-2">
        <x-input-label for="coupon_use_counts" :value="__('Coupon Use Counts')"/>
        <x-text-input id="coupon_use_counts" name="coupon_use_counts" type="number" class="form-control" value="{{ old('coupon_use_counts', $coupons->coupon_use_counts ?? '') }}" autocomplete="coupon_use_counts" placeholder="Coupon Use Counts"/>
        @error('coupon_use_counts')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div class="col-md-4 mt-2">
        <x-input-label for="is_for_all_users" :value="__('Is For All Users')"/>
{{--        <x-text-input id="is_for_all_users" name="is_for_all_users" type="text" class="form-control" value="{{ old('is_for_all_users', $coupons->is_for_all_users ?? '') }}" autocomplete="is_for_all_users" placeholder="Is For All Users"/>--}}
        <select name="is_for_all_users" id="is_for_all_users" class="form-control">
            <option value="1" {{ old('usage_type', $coupons->is_for_all_users ?? '') == 1 ? 'selected' : '' }}>For All Users</option>
            <option value="2" {{ old('usage_type', $coupons->is_for_all_users ?? '') == 2 ? 'selected' : '' }}>For Maximum Users</option>
            <option value="3" {{ old('usage_type', $coupons->is_for_all_users ?? '') == 3 ? 'selected' : '' }}>For Specific Users Only</option>
        </select>
        @error('is_for_all_users')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div class="col-md-4 mt-2">
        <x-input-label for="minimum_order_amount" :value="__('Minimum Order Amount')"/>
        <x-text-input id="minimum_order_amount" name="minimum_order_amount" type="number" class="form-control" value="{{ old('minimum_order_amount', $coupons->minimum_order_amount ?? '') }}" autocomplete="minimum_order_amount" placeholder="Minimum Order Amount"/>
        @error('minimum_order_amount')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div class="col-md-4 mt-2">
        <x-input-label for="start_date" :value="__('Start Date')"/>
        <x-text-input id="start_date" name="start_date" type="date" class="form-control" value="{{ old('start_date', isset($coupons->start_date) ? \Carbon\Carbon::parse($coupons->start_date)->format('Y-m-d') : '') }}" autocomplete="start_date" placeholder="Start Date"/>
        @error('start_date')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div class="col-md-4 mt-2">
        <x-input-label for="end_date" :value="__('End Date')"/>
        <x-text-input
            id="end_date"
            name="end_date"
            type="date"
            class="form-control"
            value="{{ old('end_date', isset($coupons->end_date) ? \Carbon\Carbon::parse($coupons->end_date)->format('Y-m-d') : '') }}"
            autocomplete="end_date"
            placeholder="End Date"
        />

        @error('end_date')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div class="col-md-4 mt-2">
        <x-input-label for="is_active" :value="__('Status')"/>
        <select id="is_active" name="is_active" class="form-control" autocomplete="is_active">
            <option value="" disabled {{ old('is_active', $coupons->is_active) === null ? 'selected' : '' }}>
                {{ __('Select Status') }}
            </option>
            @foreach($is_active as $key => $value)
                <option value="{{ $key }}" {{ old('is_active', $coupons->is_active) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        @error('is_active')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div class="col-md-6 mt-2">
        <x-input-label for="description_en" :value="__('Description En')"/>
        <x-text-input id="description_en" name="description_en" type="text" class="form-control" value="{{ old('description_en', $coupons->description_en ?? '') }}" autocomplete="description_en" placeholder="Description En"/>
        @error('description_en')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div class="col-md-6 mt-2">
        <x-input-label for="description_ar" :value="__('Description Ar')"/>
        <x-text-input id="description_ar" name="description_ar" type="text" class="form-control" value="{{ old('description_ar', $coupons->description_ar ?? '') }}" autocomplete="description_ar" placeholder="Description Ar"/>
        @error('description_ar')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

{{--    <div class="mb-3">--}}
{{--        <x-input-label for="status" :value="__('Status')" />--}}
{{--        <select id="status" name="status" class="form-control" autocomplete="status">--}}
{{--            <option value="" disabled {{ old('status', $wallet->status) === null ? 'selected' : '' }}>--}}
{{--                {{ __('Select Status') }}--}}
{{--            </option>--}}
{{--            @foreach($status as $key => $value)--}}
{{--                <option value="{{ $key }}" {{ old('status', $wallet->status) == $key ? 'selected' : '' }}>--}}
{{--                    {{ $value }}--}}
{{--                </option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--        @error('status')--}}
{{--        <x-input-error class="mt-2" :messages="$message" />--}}
{{--        @enderror--}}
{{--    </div>--}}

</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('type');
        const amountContainer = document.getElementById('amount-container');
        const percentageContainer = document.getElementById('percentage-container');
        const amountInput = amountContainer.querySelector('input'); // Assuming there is an input inside the container
        const percentageInput = percentageContainer.querySelector('input'); // Assuming there is an input inside the container

        // Function to handle the show/hide logic
        function handleTypeChange() {
            const selectedValue = typeSelect.value;

            // Show/Hide the corresponding input fields based on selected type
            if (selectedValue === 'FIXED_AMOUNT') {
                amountContainer.style.display = 'block';  // Show amount
                percentageContainer.style.display = 'none';  // Hide percentage
                if (percentageInput) percentageInput.value = 0;
            } else if (selectedValue === 'PERCENTAGE') {
                percentageContainer.style.display = 'block';  // Show percentage
                amountContainer.style.display = 'none';  // Hide amount
                if (amountInput) amountInput.value = 0;
            } else {
                amountContainer.style.display = 'none';
                percentageContainer.style.display = 'none';
                if (amountInput) amountInput.value = 0;
                if (percentageInput) percentageInput.value = 0;
            }
        }

        // Trigger the logic on initial load and on change
        typeSelect.addEventListener('change', handleTypeChange);

        // If the page is loaded with a preselected value for editing (e.g., on a form with saved data)
        handleTypeChange();  // Apply the logic when the page is loaded
    });


    {{--$(document).ready(function() {--}}
    {{--    $('#user_id').select2({--}}
    {{--        placeholder: 'Search for Customer',--}}
    {{--        minimumInputLength: 2,--}}
    {{--        ajax: {--}}
    {{--            url: '{{ route('wallet.search') }}',--}}
    {{--            dataType: 'json',--}}
    {{--            delay: 100,--}}
    {{--            headers: {--}}
    {{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--            },--}}
    {{--            data: function (params) {--}}
    {{--                return {--}}
    {{--                    query: params.term--}}
    {{--                };--}}
    {{--            },--}}
    {{--            processResults: function (data) {--}}
    {{--                return {--}}
    {{--                    results: $.map(data.users, function (user) {--}}
    {{--                        return {--}}
    {{--                            id: user.id,--}}
    {{--                            text: user.name--}}
    {{--                        };--}}
    {{--                    })--}}
    {{--                };--}}
    {{--            },--}}
    {{--            cache: true--}}
    {{--        }--}}
    {{--    });--}}

    {{--    // Set the initial value for editing--}}
    {{--    var selectedUserId = "{{ $selectedUser->id ?? '' }}"; // Pass the selected user ID--}}
    {{--    var selectedUserName = "{{ $selectedUser->name ?? '' }}"; // Pass the selected user name--}}

    {{--    if (selectedUserId && selectedUserName) {--}}
    {{--        var option = new Option(selectedUserName, selectedUserId, true, true);--}}
    {{--        $('#user_id').append(option).trigger('change');--}}
    {{--    }--}}
    {{--});--}}

    {{--$(document).ready(function() {--}}
    {{--    $('#user_id').select2({--}}
    {{--        placeholder: 'Search for Customer',--}}
    {{--        minimumInputLength: 2,--}}
    {{--        ajax: {--}}
    {{--            url: '{{ route('wallet.search') }}', // Corrected route--}}
    {{--            dataType: 'json',--}}
    {{--            delay: 100,--}}
    {{--            headers: {--}}
    {{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--            },--}}
    {{--            data: function (params) {--}}
    {{--                return {--}}
    {{--                    query: params.term // Pass the search term--}}
    {{--                };--}}
    {{--            },--}}
    {{--            processResults: function (data) {--}}
    {{--                return {--}}
    {{--                    results: $.map(data.users, function (user) {--}}
    {{--                        return {--}}
    {{--                            id: user.id,--}}
    {{--                            text: user.name--}}
    {{--                        };--}}
    {{--                    })--}}
    {{--                };--}}
    {{--            },--}}
    {{--            cache: true--}}
    {{--        }--}}
    {{--    });--}}
    {{--});--}}
</script>
