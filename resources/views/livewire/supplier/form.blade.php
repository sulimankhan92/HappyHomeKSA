
<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="name" :value="__('Name')"/>
                <x-text-input wire:model="form.name" id="name" name="name" type="text" class="form-control" autocomplete="name" placeholder="Name"/>
                @error('form.name')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="company_name" :value="__('Company Name')"/>
                <x-text-input wire:model="form.company_name" id="company_name" name="company_name" type="text" class="form-control" autocomplete="company_name" placeholder="Company Name"/>
                @error('form.company_name')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="vat_number" :value="__('Vat Number')"/>
                <x-text-input wire:model="form.vat_number" id="vat_number" name="vat_number" type="text" class="form-control" autocomplete="vat_number" placeholder="Vat Number"/>
                @error('form.vat_number')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="phone_number" :value="__('Phone Number')"/>
                <x-text-input wire:model="form.phone_number" id="phone_number" name="phone_number" type="text" class="form-control" autocomplete="phone_number" placeholder="Phone Number"/>
                @error('form.phone_number')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="image" :value="__('Image')"/>
                <x-text-input wire:model="form.image" id="image" name="image" type="text" class="form-control" autocomplete="image" placeholder="Image"/>
                @error('form.image')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="country" :value="__('Country')"/>
                <select wire:model="form.country" id="country" name="country" class="form-control country_id_select2" autocomplete="country">
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
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="address" :value="__('Address')"/>
                <x-text-input wire:model="form.address" id="address" name="address" type="text" class="form-control" autocomplete="address" placeholder="Address"/>
                @error('form.address')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="location_link" :value="__('Location Link')"/>
                <x-text-input wire:model="form.location_link" id="location_link" name="location_link" type="text" class="form-control" autocomplete="location_link" placeholder="Location Link"/>
                @error('form.location_link')
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
                @error('form.status')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>
    </div>

    </div>




{{--<div class="space-y-6">--}}

{{--    <div>--}}
{{--        <x-input-label for="name" :value="__('Name')"/>--}}
{{--        <x-text-input wire:model="form.name" id="name" name="name" type="text" class="mt-1 block w-full" autocomplete="name" placeholder="Name"/>--}}
{{--        @error('form.name')--}}
{{--            <x-input-error class="mt-2" :messages="$message"/>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <x-input-label for="company_name" :value="__('Company Name')"/>--}}
{{--        <x-text-input wire:model="form.company_name" id="company_name" name="company_name" type="text" class="mt-1 block w-full" autocomplete="company_name" placeholder="Company Name"/>--}}
{{--        @error('form.company_name')--}}
{{--            <x-input-error class="mt-2" :messages="$message"/>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <x-input-label for="vat_number" :value="__('Vat Number')"/>--}}
{{--        <x-text-input wire:model="form.vat_number" id="vat_number" name="vat_number" type="text" class="mt-1 block w-full" autocomplete="vat_number" placeholder="Vat Number"/>--}}
{{--        @error('form.vat_number')--}}
{{--            <x-input-error class="mt-2" :messages="$message"/>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <x-input-label for="phone_number" :value="__('Phone Number')"/>--}}
{{--        <x-text-input wire:model="form.phone_number" id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" autocomplete="phone_number" placeholder="Phone Number"/>--}}
{{--        @error('form.phone_number')--}}
{{--            <x-input-error class="mt-2" :messages="$message"/>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <x-input-label for="image" :value="__('Image')"/>--}}
{{--        <x-text-input wire:model="form.image" id="image" name="image" type="text" class="mt-1 block w-full" autocomplete="image" placeholder="Image"/>--}}
{{--        @error('form.image')--}}
{{--            <x-input-error class="mt-2" :messages="$message"/>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <x-input-label for="country" :value="__('Country')"/>--}}
{{--        <x-text-input wire:model="form.country" id="country" name="country" type="text" class="mt-1 block w-full" autocomplete="country" placeholder="Country"/>--}}
{{--        @error('form.country')--}}
{{--            <x-input-error class="mt-2" :messages="$message"/>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <x-input-label for="address" :value="__('Address')"/>--}}
{{--        <x-text-input wire:model="form.address" id="address" name="address" type="text" class="mt-1 block w-full" autocomplete="address" placeholder="Address"/>--}}
{{--        @error('form.address')--}}
{{--            <x-input-error class="mt-2" :messages="$message"/>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <x-input-label for="location_link" :value="__('Location Link')"/>--}}
{{--        <x-text-input wire:model="form.location_link" id="location_link" name="location_link" type="text" class="mt-1 block w-full" autocomplete="location_link" placeholder="Location Link"/>--}}
{{--        @error('form.location_link')--}}
{{--            <x-input-error class="mt-2" :messages="$message"/>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--    <div>--}}
{{--        <x-input-label for="status" :value="__('Status')"/>--}}
{{--        <x-text-input wire:model="form.status" id="status" name="status" type="text" class="mt-1 block w-full" autocomplete="status" placeholder="Status"/>--}}
{{--        @error('form.status')--}}
{{--            <x-input-error class="mt-2" :messages="$message"/>--}}
{{--        @enderror--}}
{{--    </div>--}}

{{--    <div class="flex items-center gap-4">--}}
{{--        <x-primary-button>Submit</x-primary-button>--}}
{{--    </div>--}}
{{--</div>--}}
