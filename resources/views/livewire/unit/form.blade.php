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
        <x-input-label for="status" :value="__('Status')"/>
                <select wire:model="form.status" id="status" name="status" class="form-control" autocomplete="status">
                    <option value="" disabled>Select Status</option>
                    @foreach(App\Models\Unit::getStatusOptions() as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                @error('form.status')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div>
    </div>
    </div>

