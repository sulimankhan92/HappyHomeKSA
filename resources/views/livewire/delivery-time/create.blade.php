<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>{{ __('Create') }} Delivery Time</h3>
                </div>
{{--                <div class="col-sm-6 pe-0">--}}
{{--                    <ol class="breadcrumb">--}}
{{--                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}" >--}}
{{--                                <svg class="stroke-icon">--}}
{{--                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>--}}
{{--                                </svg></a></li>--}}
{{--                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('products.index') }}"> Products</a></li>--}}
{{--                        <li class="breadcrumb-item active"> {{ __('Create') }} Procuct</li>--}}
{{--                    </ol>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                        </div>
                        <div class="card-body">
                            <form method="POST" wire:submit="save" role="form" enctype="multipart/form-data">
                                @csrf
                                @include('livewire.delivery-time.form')
                                <div class="flex items-center justify-end mt-4">
                                    <x-primary-button class="btn btn-primary">
                                        {{ __('Create Delivery Time') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{--<x-slot name="header">--}}
{{--    <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--        {{ __('Create') }} Delivery Time--}}
{{--    </h2>--}}
{{--</x-slot>--}}

{{--<div class="py-12">--}}
{{--    <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">--}}
{{--        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--            <div class="w-full">--}}
{{--                <div class="sm:flex sm:items-center">--}}
{{--                    <div class="sm:flex-auto">--}}
{{--                        <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Create') }} Delivery Time</h1>--}}
{{--                        <p class="mt-2 text-sm text-gray-700">Add a new {{ __('Delivery Time') }}.</p>--}}
{{--                    </div>--}}
{{--                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">--}}
{{--                        <a type="button" wire:navigate href="{{ route('delivery-times.index') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back</a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="flow-root">--}}
{{--                    <div class="mt-8 overflow-x-auto">--}}
{{--                        <div class="max-w-xl py-2 align-middle">--}}
{{--                            <form method="POST" wire:submit="save" role="form" enctype="multipart/form-data">--}}
{{--                                @csrf--}}
{{--                                @include('livewire.delivery-time.form')--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

