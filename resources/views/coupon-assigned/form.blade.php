<div class="space-y-6">

    <div>
        <x-input-label for="coupon_id" :value="__('Coupon Id')"/>
        <select id="coupon_id" class="form-control coupon_id" name="coupon_id">
            @if(isset($selectedCoupon))
                <option value="{{ $selectedCoupon->id }}" selected>{{ $selectedCoupon->title_en }}</option>
            @else
                <option value="">Select Customer</option>
            @endif
        </select>
        @error('coupon_id')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="user_id" :value="__('User Id')"/>
        <select id="user_id" class="form-control user_id" name="user_id">
            @if(isset($selectedUser))
                <option value="{{ $selectedUser->id }}" selected>{{ $selectedUser->name }}</option>
            @else
                <option value="">Select Customer</option>
            @endif
        </select>
        @error('user_id')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>

{{--    <div>--}}
{{--        <x-input-label for="used_count" :value="__('Used Count')"/>--}}
{{--        <x-text-input id="used_count" name="used_count" type="text" class="mt-1 block w-full" autocomplete="used_count" placeholder="Used Count"/>--}}
{{--        @error('used_count')--}}
{{--        <x-input-error class="mt-2" :messages="$message"/>--}}
{{--        @enderror--}}
{{--    </div>--}}
    <div>
        <x-input-label for="is_active" :value="__('Is Active')"/>
        <select id="is_active" name="is_active" class="form-control" autocomplete="is_active">
            <option value="" disabled {{ old('is_active', $coupons_assigned_user->is_active) === null ? 'selected' : '' }}>
                {{ __('Select Status') }}
            </option>
            @foreach($is_active as $key => $value)
                <option value="{{ $key }}" {{ old('is_active', $coupons_assigned_user->is_active) == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        @error('is_active')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>


</div>


<script>

    $(document).ready(function() {
        $('#user_id').select2({
            placeholder: 'Search for Customer',
            minimumInputLength: 2,
            ajax: {
                url: '{{ route('wallet.search') }}',
                dataType: 'json',
                delay: 100,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (params) {
                    return {
                        query: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.users, function (user) {
                            return {
                                id: user.id,
                                text: user.name
                            };
                        })
                    };
                },
                cache: true
            }
        });

        // Set the initial value for editing
        var selectedUserId = "{{ $selectedUser->id ?? '' }}"; // Pass the selected user ID
        var selectedUserName = "{{ $selectedUser->name ?? '' }}"; // Pass the selected user name

        if (selectedUserId && selectedUserName) {
            var option = new Option(selectedUserName, selectedUserId, true, true);
            $('#user_id').append(option).trigger('change');
        }

        $('#coupon_id').select2({
            placeholder: 'Search for Customer',
            minimumInputLength: 2,
            ajax: {
                url: '{{ route('coupon.search') }}',
                dataType: 'json',
                delay: 100,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (params) {
                    return {
                        query: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.coupons, function (coupon) {
                            return {
                                id: coupon.id,
                                text: coupon.name
                            };
                        })
                    };
                },
                cache: true
            }
        });

        // Set the initial value for editing
        var selectedCouponId = "{{ $selectedCoupon->id ?? '' }}";
        var selectedCouponName = "{{ $selectedCoupon->name ?? '' }}";

        if (selectedCouponId && selectedCouponName) {
            var option = new Option(selectedCouponName, selectedCouponId, true, true);
            $('#coupon_id').append(option).trigger('change');
        }
    });
</script>
