<div class="card-body">
    <div class="row">
        <div class="col-md-6">
                <div class="mb-3">
            <x-input-label for="category_id" :value="__('Category')"/>
                    <select wire:model="form.category_id" id="category_id" name="category_id" class="form-control category_id_select2" autocomplete="category_id">
                        <option value="" disabled>Select Status</option>
                        @foreach(App\Models\Category::where('status','1')->get() as $key => $value)
                            <option value="{{ $value->id }}">{{ $value->name_en }}</option>
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
            <x-text-input wire:model="form.name_en" id="name_en" name="name_en" type="text" class="form-control"  autocomplete="name_en" placeholder="Name En"/>
            @error('form.name_en')
                <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <x-input-label for="name_ar" :value="__('Name Ar')"/>
            <x-text-input wire:model="form.name_ar" id="name_ar" name="name_ar" type="text" class="form-control"  autocomplete="name_ar" placeholder="Name Ar"/>
            @error('form.name_ar')
                <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <x-input-label for="detail_en" :value="__('Detail En')"/>
            <x-text-input wire:model="form.detail_en" id="detail_en" name="detail_en" type="text" class="form-control"  autocomplete="detail_en" placeholder="Detail En"/>
            @error('form.detail_en')
                <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <x-input-label for="detail_ar" :value="__('Detail Ar')"/>
            <x-text-input wire:model="form.detail_ar" id="detail_ar" name="detail_ar" type="text" class="form-control"  autocomplete="detail_ar" placeholder="Detail Ar"/>
            @error('form.detail_ar')
                <x-input-error class="mt-2" :messages="$message"/>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <x-input-label for="order" :value="__('Order')"/>
            <x-text-input wire:model="form.order" id="order" name="order" type="number" class="form-control"  autocomplete="order" placeholder="Order"/>
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
                <label class="form-label" for="formFileSimple">Default file 1</label>
                <input class="form-control btn-pill px-4" name="images[]" id="formFileSimple" type="file">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label" for="formFileSimple">Default file 2</label>
                <input class="form-control btn-pill px-4" name="images[]" id="formFileSimple" type="file">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label" for="formFileSimple">Default file 3</label>
                <input class="form-control btn-pill px-4" name="images[]" id="formFileSimple" type="file">
            </div>
        </div>
    </div>
</div>

