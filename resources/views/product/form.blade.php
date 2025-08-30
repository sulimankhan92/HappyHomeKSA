<div class="card-body">
    <div class="row">
        <div class="col-md-4">
            <div class="mb-1">
                <x-input-label for="secondary_category_id" :value="__('Category')"/>
                <select id="secondary_category_id" name="secondary_category_id[]"
                        class="form-control secondary_category_select2"
                        autocomplete="secondary_category_id"
                        multiple="multiple">
                    <option value="" disabled>Select Category</option>
                    @foreach($secondaryCategories as $category)
                        <option value="{{ $category->id }}"
                            {{ in_array($category->id, old('secondary_category_id', isset($product) ? $product->secondaryCategories->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                            {{ $category->name_en }}
                        </option>
                    @endforeach
                </select>
                @error('secondary_category_id')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-1">
                <x-input-label for="product_manufacture_id" :value="__('Product Manufacture')"/>
                <select id="product_manufacture_id" name="product_manufacture_id" class="form-control product_manufacture_id_select2" autocomplete="product_manufacture_id">
                    <option value="" disabled>Select Manufacture</option>
                    @foreach($productManufacturer as $key => $value)
                        <option value="{{ $value->id }}"
                            {{ (old('product_manufacture_id', $product?->product_manufacture_id ?? '') == $value->id) ? 'selected' : '' }}>
                            {{ $value->name_en }}
                        </option>
                    @endforeach
                </select>
                @error('product_manufacture_id')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-1">
                <x-input-label for="supplier_id" :value="__('Supplier')"/>
                <select id="supplier_id" name="supplier_id" class="form-control supplier_id_select2">
                    <option value="" >Select Supplier</option>
                    @foreach($suppliers as $key => $supplier)
                        <option value="{{ $supplier->id }}"
                            {{ old('supplier_id', $product?->supplier_id ?? '') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
                @error('supplier_id')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-1">
                <x-input-label for="product_brand_id" :value="__('Brands')"/>
                <select id="product_brand_id" name="product_brand_id" class="form-control supplier_id_select2">
                    <option value="">Select Brand</option>
                    @foreach($productBrands as $key => $brand)
                        <option value="{{ $brand->id }}"
                            {{ old('product_brand_id', $product?->product_brand_id ?? '') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_brand_id')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <x-input-label for="name_en" :value="__('Name En')"/>
                <x-text-input id="name_en" name="name_en" type="text" class="form-control" value="{{ old('name_en', $product?->name_en) }}" autocomplete="name_en" placeholder="Name En"/>
                @error('name_en')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <x-input-label for="name_ar" :value="__('Name Ar')"/>
                <x-text-input id="name_ar" name="name_ar" type="text" class="form-control" value="{{ old('name_ar', $product?->name_ar) }}" autocomplete="name_ar" placeholder="Name Ar"/>
                @error('name_ar')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <x-input-label for="order" :value="__('Order')"/>
                <x-text-input id="order" name="order" type="number" class="form-control" value="{{ old('order', $product?->order) }}" autocomplete="order" placeholder="Order"/>
                @error('order')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <x-input-label for="box_size" :value="__('Box Size')"/>
                <x-text-input id="box_size" name="box_size" type="number" class="form-control" value="{{ old('box_size', $product?->box_size) }}" autocomplete="box_size" placeholder="Box Size"/>
                @error('box_size')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <x-input-label for="barcode" :value="__('Barcode')"/>
                <x-text-input id="barcode" name="barcode" type="text" class="form-control" value="{{ old('barcode', $product?->barcode) }}" autocomplete="barcode" placeholder="Barcode"/>
                @error('barcode')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <x-input-label for="min_purchase" :value="__('Min Purchase')"/>
                <x-text-input id="min_purchase" name="min_purchase" type="number" class="form-control" value="{{ old('min_purchase', $product?->min_purchase) }}" autocomplete="min_purchase" placeholder="Min Purchase"/>
                @error('min_purchase')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <x-input-label for="max_purchase" :value="__('Max Purchase')"/>
                <x-text-input id="max_purchase" name="max_purchase" type="number" class="form-control" value="{{ old('max_purchase', $product?->max_purchase) }}" autocomplete="max_purchase" placeholder="Max Purchase"/>
                @error('max_purchase')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-1">
                <x-input-label for="country_id" :value="__('Country')"/>
                <select id="country_id" name="country_id" class="form-control country_id_select2" autocomplete="country_id">
                    <option value="" disabled>Select Status</option>
                    @foreach(App\Models\Country::select('id', 'name_en')->get() as $country)
                        <option value="{{ $country->id }}" {{ old('country_id', $product?->country_id) == $country->id ? 'selected' : '' }}>{{ $country->name_en }}</option>
                    @endforeach
                </select>
                @error('country_id')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-1">
                <x-input-label for="product_location" :value="__('Product Location')"/>
                <x-text-input id="product_location" name="product_location" type="text" class="form-control" value="{{ old('product_location', $product?->product_location) }}" autocomplete="product_location" placeholder="Product Location"/>
                @error('product_location')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-1">
                <x-input-label for="status" :value="__('Status')"/>
                <select id="status" name="status" class="form-control" autocomplete="status">
                    <option value="" disabled>Select Status</option>
                    @foreach(App\Models\Product::getStatusOptions() as $key => $value)
                        <option value="{{ $key }}" {{ old('status', $product?->status) == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
                @error('status')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <x-input-label for="name_en" :value="__('Top Listed')"/>
            <div class="form-check checkbox-checked">
                <input class="form-check-input" name="top_listed" id="gridCheck1" type="checkbox" <?= ($product?->top_listed == 1) ? 'checked' : ''; ?>>
                <label class="form-check-label" for="gridCheck1">Check me out</label>
            </div>
        </div>
        {{--        <div class="col-md-4">--}}
        {{--            <div class="mb-3">--}}
        {{--                <x-input-label for="name_en" :value="__('Top Listed')"/>--}}
        {{--                <div class="d-inline-block">--}}
        {{--                    <label class="d-block mb-0" for="chk-ani">--}}
        {{--                        <input class="checkbox_animated" id="chk-ani"  name="top_listed" type="checkbox">Remind on--}}
        {{--                    </label>--}}
        {{--                </div>--}}
        {{--                <x-text-input id="is_show_top_listed" name="top_listed" type="text" class="form-control" value="{{ old('name_en', $product?->name_en) }}" autocomplete="name_en" placeholder="Name En"/>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="description_en" :value="__('Description En')"/>
                <x-text-input id="description_en" name="description_en" type="text" class="form-control" value="{{ old('description_en', $product?->description_en) }}" autocomplete="description_en" placeholder="Description"/>
                @error('description_en')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="description_ar" :value="__('Description Ar')"/>
                <x-text-input id="description_ar" name="description_ar" type="text" class="form-control"  value="{{ old('description_ar', $product?->description_ar) }}" autocomplete="description_ar" placeholder="Description"/>
                @error('description_ar')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label" for="formFileSimple">Default Image</label>
                <input class="form-control btn-pill px-4" name="images[]" id="formFileSimple" type="file">
                {{--                @error('images')--}}
                {{--                <div class="text-danger">--}}
                {{--                    {{ $message }}--}}
                {{--                </div>--}}
                {{--                @enderror--}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label" for="formFileSimple">Image 2</label>
                <input class="form-control btn-pill px-4" name="images[]" id="formFileSimple" type="file">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label" for="formFileSimple">Image 3</label>
                <input class="form-control btn-pill px-4" name="images[]" id="formFileSimple" type="file">
            </div>
        </div>
        @if(isset($product))
            @foreach($product->productImages as $image)
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('storage/products/' . $image->file_name) }}" alt="Product Image" class="img-thumbnail">
                    <input type="checkbox" name="remove_images[]" value="{{ $image->id }}"> Remove
                </div>
            @endforeach
        @endif
    </div>
</div>

<script>
    document.getElementById('barcode').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
        }
    });

    // You can still submit the form by clicking the submit button
</script>
