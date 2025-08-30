<div class="card-body">
    <div class="row">

        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="name_en" :value="__('Name En')"/>
                <x-text-input wire:model="form.name_en" id="name_en" name="name_en" type="text" class="form-control" autocomplete="name_en" placeholder="Name En"/>
                @error('form.name_en')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="name_ar" :value="__('Name Ar')"/>
                <x-text-input wire:model="form.name_ar" id="name_ar" name="name_ar" type="text" class="form-control" autocomplete="name_ar" placeholder="Name Ar"/>
                @error('form.name_ar')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="description_en" :value="__('Description En')"/>
                <x-text-input wire:model="form.description_en" id="description_en" name="description_en" type="text" class="form-control" autocomplete="description_en" placeholder="Description En"/>
                @error('form.description_en')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="description_ar" :value="__('Description Ar')"/>
                <x-text-input wire:model="form.description_ar" id="description_ar" name="description_ar" type="text" class="form-control" autocomplete="description_ar" placeholder="Description Ar"/>
                @error('form.description_ar')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="logo" :value="__('Logo')"/>
                <x-text-input wire:model="form.logo" id="logo" name="logo" type="text" class="form-control" autocomplete="logo" placeholder="Logo"/>
                @error('form.logo')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="status" :value="__('Status')"/>
                <select wire:model="form.status" id="status" name="status" class="form-control" autocomplete="status">
                    <option value="" disabled>Select Status</option>
                    @foreach(App\Models\Supplier::getStatusOptions() as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                {{--        <x-text-input wire:model="form.status" id="status" name="status" type="text" class="form-control" autocomplete="status" placeholder="Status"/>--}}
                @error('form.status')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="country_id" :value="__('Country')"/>
                <select wire:model="form.country_id" id="country_id" name="country_id" class="form-control country_id_select2" autocomplete="country_id">
                    <option value="" >Select Country</option>
                    @foreach(App\Models\Country::select('id', 'name_en')->get() as $country)
                        <option value="{{ $country->id }}">{{ $country->name_en }}</option>
                    @endforeach
                </select>
                @error('form.country_id')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>
        {{--        <div class="col-md-6">--}}
        {{--            <div class="mb-3">--}}
        {{--                <x-input-label for="created_by" :value="__('Created By')"/>--}}
        {{--                <x-text-input wire:model="form.created_by" id="created_by" name="created_by" type="text" class="form-control" autocomplete="created_by" placeholder="Created By"/>--}}
        {{--                @error('form.created_by')--}}
        {{--                <x-input-error class="mt-2" :messages="$message"/>--}}
        {{--                @enderror--}}
        {{--            </div>--}}
        {{--        </div>--}}

    </div>
</div>
