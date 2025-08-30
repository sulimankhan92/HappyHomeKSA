<div class="card-body">
    <div class="row">
        <div class="col-md-6">
                <div class="mb-3">
            <x-input-label for="category_id" :value="__('Category')"/>
                    <select id="category_id" name="category_id" class="form-control category_id_select2" autocomplete="category_id">
                        <option value="" disabled>Select Status</option>
                        @foreach($categories as $key => $category)
                            <option value="{{ $category->id }}"
                                {{ (in_array($category->id, old('category_id', [$secondaryCategory->category_id ?? '']))) ? 'selected' : '' }}
                            >
                                {{ $category->name_en }}
                            </option>
                        @endforeach
                    </select>

                    @error('form.category_id')
                <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <x-input-label for="name_en" :value="__('Name En')"/>
            <x-text-input id="name_en" name="name_en" type="text" value="{{ old('order', $secondaryCategory?->name_en) }}" class="form-control"  autocomplete="name_en" placeholder="Name En"/>
            @error('form.name_en')
                <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <x-input-label for="name_ar" :value="__('Name Ar')"/>
            <x-text-input id="name_ar" name="name_ar" type="text" value="{{ old('order', $secondaryCategory?->name_ar) }}" class="form-control"  autocomplete="name_ar" placeholder="Name Ar"/>
            @error('form.name_ar')
                <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <x-input-label for="detail_en" :value="__('Detail En')"/>
            <x-text-input id="detail_en" name="detail_en" type="text" value="{{ old('order', $secondaryCategory?->detail_en) }}" class="form-control"  autocomplete="detail_en" placeholder="Detail En"/>
            @error('form.detail_en')
                <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <x-input-label for="detail_ar" :value="__('Detail Ar')"/>
            <x-text-input id="detail_ar" name="detail_ar" type="text" value="{{ old('order', $secondaryCategory?->detail_ar) }}" class="form-control"  autocomplete="detail_ar" placeholder="Detail Ar"/>
            @error('form.detail_ar')
                <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <x-input-label for="order" :value="__('Order')"/>
            <x-text-input id="order" name="order" type="number" value="{{ old('order', $secondaryCategory?->order) }}" class="form-control"  autocomplete="order" placeholder="Order"/>
            @error('form.order')
                <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <x-input-label for="status" :value="__('Status')"/>
            <select wire:model="form.status" id="status" name="status" class="form-control" autocomplete="status">
                <option value="" disabled>Select Status</option>
                @foreach(App\Models\Category::getStatusOptions() as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            @error('form.status')
                <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>
    </div>
        <div class="col-md-6">
        </div>
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
        @if(isset($secondaryCategory))
            @foreach($secondaryCategory->secondaryCategoryImages as $image)
                <div class="col-md-4 mb-3">
                    <img width="300px" src="{{ asset('storage/secondary_category/' . $image->images) }}" alt="Category Image" class="img-thumbnail">
                    <input type="checkbox" name="remove_images[]" value="{{ $image->id }}"> Remove
                </div>
            @endforeach
        @endif
    </div>
</div>

