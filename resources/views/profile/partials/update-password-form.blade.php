
<form method="post" action="{{ route('password.update') }}" class="card">
        @csrf
        @method('put')
    <div class="card-header pb-0">
        <h3 class="card-title mb-0"> {{ __('Update Password') }}</h3>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Ensure your account is using a long, random password to stay secure.') }}
                </p>
        <div class="card-options">
            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Current Password</label>
                </div>
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control"  autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <x-text-input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <x-primary-button class="btn btn-primary">Update Password</x-primary-button>
        @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
            >{{ __('Saved.') }}</p>
        @endif

    </div>
</form>



{{--<section>--}}
{{--    <header>--}}
{{--        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">--}}
{{--            {{ __('Update Password') }}--}}
{{--        </h2>--}}
{{--        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">--}}
{{--            {{ __('Ensure your account is using a long, random password to stay secure.') }}--}}
{{--        </p>--}}
{{--    </header>--}}
{{--    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">--}}
{{--        @csrf--}}
{{--        @method('put')--}}
{{--        <div>--}}
{{--            <x-input-label for="update_password_current_password" :value="__('Current Password')" />--}}
{{--            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />--}}
{{--            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <x-input-label for="update_password_password" :value="__('New Password')" />--}}
{{--            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />--}}
{{--            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />--}}
{{--            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />--}}
{{--            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}
{{--        <div class="flex items-center gap-4">--}}
{{--            <x-primary-button>{{ __('Save') }}</x-primary-button>--}}
{{--            @if (session('status') === 'password-updated')--}}
{{--                <p--}}
{{--                    x-data="{ show: true }"--}}
{{--                    x-show="show"--}}
{{--                    x-transition--}}
{{--                    x-init="setTimeout(() => show = false, 2000)"--}}
{{--                    class="text-sm text-gray-600 dark:text-gray-400"--}}
{{--                >{{ __('Saved.') }}</p>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</section>--}}
