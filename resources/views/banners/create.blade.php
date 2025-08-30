<x-app-layout>
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6 ps-0">
                        <h3>{{ __('Create') }} Banner</h3>
                    </div>
                    <div class="col-sm-6 pe-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" >
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                    </svg></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('banners.index') }}"> Banner</a></li>
                            <li class="breadcrumb-item active"> {{ __('Create') }} Banner</li>
                        </ol>
                    </div>
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
                                <x-alert />
                                <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="space-y-6">

                                        <div class="mb-3">
                                            <x-input-label for="image" value="Image"/>
                                            <x-text-input id="image" name="image" type="file" class="form-control" value="image" required/>
                                            @error('image')
                                            <x-input-error class="mt-2" :messages="$message"/>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="order_number">Order Number:</label>
                                            <input type="number" class="form-control" name="order_number" id="order_number" required>
                                            @error('order_number')
                                                <x-input-error class="mt-2" :messages="$message"/>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="status">Status:</label>
                                            <select class="form-control"  name="status" id="status" required>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            @error('status')
                                            <x-input-error class="mt-2" :messages="$message"/>
                                            @enderror
                                        </div>
                                        <div class="flex items-center justify-end mt-4">
                                            <x-primary-button class="btn btn-primary">
                                                {{ __('Create New Banner') }}
                                            </x-primary-button>
                                        </div>
                                    </div>
                                </form>
{{--                                <form method="POST" action="{{ route('productBrands.store') }}" role="form" enctype="multipart/form-data">--}}
{{--                                    @csrf--}}
{{--                                    @include('brands.form')--}}
{{--                                    <div class="flex items-center justify-end mt-4">--}}
{{--                                        <x-primary-button class="btn btn-primary">--}}
{{--                                            {{ __('Create New Product Brand') }}--}}
{{--                                        </x-primary-button>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
