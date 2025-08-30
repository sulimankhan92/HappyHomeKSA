<div class="card-body">
    <div class="row">

    <div class="col-md-6">
            <div class="mb-3">
        <x-input-label for="secondary_category_id" :value="__('Secondary Category')"/>
        <select wire:model="form.secondary_category_id" id="secondary_category_id" name="secondary_category_id" class="form-control secondary_category_select2" autocomplete="secondary_category_id">
            <option value="" disabled>Select Secondary Category</option>
            @foreach(App\Models\SecondaryCategory::all() as $key => $value)
                <option value="{{ $value->id }}">{{ $value->name_en }}</option>
            @endforeach
        </select>

        @error('form.secondary_category_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    </div>
    <div class="col-md-6">
            <div class="mb-3">
        <x-input-label for="product_manufacture_id" :value="__('Product Manufacture')"/>
        <select wire:model="form.product_manufacture_id" id="product_manufacture_id" name="product_manufacture_id" class="form-control product_manufacture_id_select2" autocomplete="product_manufacture_id">
            <option value="" disabled>Select Manufacture</option>
            @foreach(App\Models\ProductManufacturer::all() as $key => $value)
                <option value="{{ $value->id }}">{{ $value->name_en }}</option>
            @endforeach
        </select>
        @error('form.product_manufacture_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    </div>
{{--    <div class="col-md-6">--}}
{{--            <div class="mb-3">--}}
{{--        <x-input-label for="product_warehouse_id" :value="__('Product Warehouse Id')"/>--}}
{{--        <x-text-input wire:model="form.product_warehouse_id" id="product_warehouse_id" name="product_warehouse_id" type="text" class="form-control" autocomplete="product_warehouse_id" placeholder="Product Warehouse Id"/>--}}
{{--        @error('form.product_warehouse_id')--}}
{{--            <x-input-error class="mt-2" :messages="$message"/>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--    </div>--}}
    <div class="col-md-6">
            <div class="mb-3">
        <x-input-label for="supplier_id" :value="__('Supplier')"/>
        <select wire:model="form.supplier_id" id="supplier_id" name="supplier_id" class="form-control supplier_id_select2" autocomplete="supplier_id">
            <option value="" disabled>Select Supplier</option>
            @foreach(App\Models\Supplier::all() as $key => $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
        @error('form.supplier_id')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    </div>
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
        <x-input-label for="order" :value="__('Order')"/>
        <x-text-input wire:model="form.order" id="order" name="order" type="number" class="form-control" autocomplete="order" placeholder="Order"/>
        @error('form.order')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    </div>
    <div class="col-md-6">
            <div class="mb-3">
        <x-input-label for="box_size" :value="__('Box Size')"/>
        <x-text-input wire:model="form.box_size" id="box_size" name="box_size" type="number" class="form-control" autocomplete="box_size" placeholder="Box Size"/>
        @error('form.box_size')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    </div>
    <div class="col-md-6">
            <div class="mb-3">
        <x-input-label for="barcode" :value="__('Barcode')"/>
        <x-text-input wire:model="form.barcode" id="barcode" name="barcode" type="text" class="form-control" autocomplete="barcode" placeholder="Barcode"/>
        @error('form.barcode')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    </div>
    <div class="col-md-6">
            <div class="mb-3">
        <x-input-label for="product_location" :value="__('Product Location')"/>
        <x-text-input wire:model="form.product_location" id="product_location" name="product_location" type="text" class="form-control" autocomplete="product_location" placeholder="Product Location"/>
        @error('form.product_location')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    </div>
    <div class="col-md-6">
            <div class="mb-3">
        <x-input-label for="status" :value="__('Status')"/>
                <select wire:model="form.status" id="status" name="status" class="form-control" autocomplete="status">
                    <option value="" disabled>Select Status</option>
                    @foreach(App\Models\Product::getStatusOptions() as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>        @error('form.status')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="country_id" :value="__('Country')"/>
                <select wire:model="form.country_id" id="country_id" name="country_id" class="form-control country_id_select2" autocomplete="country_id">
                    <option value="" disabled>Select Status</option>
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
                <x-input-label for="min_purchase" :value="__('Min Purchase')"/>
                <x-text-input wire:model="form.min_purchase" id="min_purchase" name="min_purchase" type="number" class="form-control" autocomplete="min_purchase" placeholder="Min Purchase"/>
                @error('form.min_purchase')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="max_purchase" :value="__('Max Purchase')"/>
                <x-text-input wire:model="form.max_purchase" id="max_purchase" name="max_purchase" type="number" class="form-control" autocomplete="max_purchase" placeholder="Max Purchase"/>
                @error('form.order')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>
</div>
</div>
