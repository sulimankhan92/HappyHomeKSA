<x-app-layout>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>{{ __('Update') }} Secondary Category</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('dashboard') }}" >
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('secondary-categories.index') }}" >Secondary Categories</a></li>
                        <li class="breadcrumb-item active"> {{ __('Update') }} Secondary Category</li>
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
                            <form method="POST" action="{{ route('secondary-categories.update', $secondaryCategory->id) }}" role="form" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @include('secondaryCategory.form')
                                <div class="flex items-center justify-end mt-4">
                                    <x-primary-button class="btn btn-primary">
                                        {{ __('Update Secondary Category') }}
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
</x-app-layout>
