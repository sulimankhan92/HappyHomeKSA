<div class="space-y-6">

    <div>
        <label for="search-prod">Find Customer</label>
        <select id="user_id" class="form-control user_id" name="user_id">
            @if(isset($selectedUser))
                <option value="{{ $selectedUser->id }}" selected>{{ $selectedUser->name }}</option>
            @else
                <option value="">Select Customer</option>
            @endif
        </select>
        @error('user_id')
        <x-input-error class="mt-2" :messages="$message" />
        @enderror
    </div>


    <div>
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input id="name" name="name" type="text" class="form-control" value="{{ old('name', $wallet?->name) }}" autocomplete="name" placeholder="Name"/>
        @error('name')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="balance" :value="__('balance')"/>
        <x-text-input id="balance" name="balance" type="text" class="form-control" value="{{ old('balance', $wallet?->balance) }}" autocomplete="balance" placeholder="Balance"/>
        @error('balance')
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
    });

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
