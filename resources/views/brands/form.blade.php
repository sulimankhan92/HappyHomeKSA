<div class="space-y-6">

    <div>
        <x-input-label for="name" :value="__('Name')"/>
        <x-text-input id="name" name="name" type="text" class="form-control" value="{{ old('name', $brand?->name) }}" autocomplete="name" placeholder="Name"/>
        @error('name')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="name_ar" :value="__('Name ar')"/>
        <x-text-input id="name_ar" name="name_ar" type="text" class="form-control" value="{{ old('name_ar', $brand?->name_ar) }}" autocomplete="name_ar" placeholder="Name ar"/>
        @error('v')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div>
        <x-input-label for="logo" :value="__('Logo')"/>
        <x-text-input id="logo" name="images[]" type="file" class="form-control" autocomplete="logo" placeholder="Logo"/>
        @error('logo')
        <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <x-input-label for="status" :value="__('Status')"/>
            <select id="status" name="status" class="form-control" autocomplete="status">
                <option value="" disabled>Select Status</option>
                @foreach(App\Models\ProductBrand::getStatusOptions() as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>        @error('status')
            <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>

        @if(isset($brand) && !empty($brand->logo))
            <div class="col-md-4 mb-3">
                <img width="300px" src="{{ asset('storage/brands/' . $brand->logo) }}" alt="Brands Image" class="img-thumbnail">
            </div>
        @endif
    </div>
