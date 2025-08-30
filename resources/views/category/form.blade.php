<div class="card-body">
    <div class="row">

        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="name_en" :value="__('Name En')"/>
                <x-text-input id="name_en" name="name_en" type="text" class="form-control" value="{{ old('name_en', $category?->name_en) }}" autocomplete="name_en" placeholder="Name En"/>
                @error('name_en')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="name_ar" :value="__('Name Ar')"/>
                <x-text-input id="name_ar" name="name_ar" type="text" class="form-control" value="{{ old('name_ar', $category?->name_ar) }}" autocomplete="name_ar" placeholder="Name Ar"/>
                @error('name_ar')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="detail_en" :value="__('Detail En')"/>
                <x-text-input id="detail_en" name="detail_en" type="text" class="form-control" value="{{ old('detail_en', $category?->detail_en) }}" autocomplete="detail_en" placeholder="Detail En"/>
                @error('detail_en')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="detail_ar" :value="__('Detail Ar')"/>
                <x-text-input id="detail_ar" name="detail_ar" type="text" class="form-control" value="{{ old('detail_ar', $category?->detail_ar) }}" autocomplete="detail_ar" placeholder="Detail Ar"/>
                @error('detail_ar')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="order" :value="__('Order')"/>
                <x-text-input id="order" name="order" type="number" class="form-control" value="{{ old('order', $category?->order) }}" autocomplete="order" placeholder="Order"/>
                @error('order')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="status" :value="__('Status')"/>
                <select id="status" name="status" class="form-control" autocomplete="status">
                    <option value="" disabled>Select Status</option>
                    @foreach(App\Models\Category::getStatusOptions() as $key => $status)
                        <option value="{{ $key }}" {{ old('status', $category?->status) == $key ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @error('form.status')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="gb_color" :value="__('Background Color')"/>
                <x-text-input id="gb_color" name="gb_color" type="color" class="form-control form-control-color" value="{{ old('gb_color', $category?->gb_color) }}" autocomplete="gb_color" placeholder="#5b5b5b"/>
                @error('gb_color')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="text_color" :value="__('Text Color')"/>
                <x-text-input id="text_color" name="text_color" type="color" class="form-control form-control-color" value="{{ old('text_color', $category?->text_color) }}" autocomplete="text_color" placeholder="#dee1e2"/>
                @error('text_color')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        {{--        <div class="col-md-4">--}}
        {{--            <div class="mb-3">--}}
        {{--                <label class="form-label" for="formFileSimple">Default file 1</label>--}}
        {{--                <input class="form-control btn-pill px-4" id="formFileSimple" type="file">--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="col-md-4">--}}
        {{--            <div class="mb-3">--}}
        {{--                <label class="form-label" for="formFileSimple">Default file 2</label>--}}
        {{--                <input class="form-control btn-pill px-4" id="formFileSimple" type="file">--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="col-md-4">--}}
        {{--            <div class="mb-3">--}}
        {{--                <label class="form-label" for="formFileSimple">Default file 3</label>--}}
        {{--                <input class="form-control btn-pill px-4" id="formFileSimple" type="file">--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label" for="formFileSimple">Default Image</label>
                <input class="form-control btn-pill px-4" name="images[]" id="formFileSimple" type="file">
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
        @if(isset($category))
            @foreach($category->categoryImages as $image)
                <div class="col-md-4 mb-3">
                    <img width="300px" src="{{ asset('storage/category/' . $image->file_name) }}" alt="Category Image" class="img-thumbnail">
                    <input type="checkbox" name="remove_images[]" value="{{ $image->id }}"> Remove
                </div>
            @endforeach
        @endif
    </div>
</div>
