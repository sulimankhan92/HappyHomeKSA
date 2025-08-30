<div class="card-body">
    <div class="row">

    <div class="col-md-6">
            <div class="mb-3">
        <x-input-label for="packaging_level" :value="__('Packaging Level')"/>
        <x-text-input wire:model="form.packaging_level" id="packaging_level" name="packaging_level" type="text" class="form-control" autocomplete="packaging_level" placeholder="Packaging Level"/>
        @error('form.packaging_level')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div></div>
    <div class="col-md-6">
            <div class="mb-3">
        <x-input-label for="quantity" :value="__('Quantity')"/>
        <x-text-input wire:model="form.quantity" id="quantity" name="quantity" type="number" class="form-control" autocomplete="quantity" placeholder="Quantity"/>
        @error('form.quantity')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div></div>
    <div class="col-md-6">
            <div class="mb-3">
        <x-input-label for="conversion_rate" :value="__('Conversion Rate')"/>
        <x-text-input wire:model="form.conversion_rate" id="conversion_rate" name="conversion_rate" type="number" class="form-control" autocomplete="conversion_rate" placeholder="Conversion Rate"/>
        @error('form.conversion_rate')
            <x-input-error class="mt-2" :messages="$message"/>
        @enderror
    </div></div>
    <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="status" :value="__('Status')"/>
                <select wire:model="form.status" id="status" name="status" class="form-control" autocomplete="status">
                    <option value="" disabled>Select Status</option>
                    @foreach(App\Models\ProductPacking::getStatusOptions() as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                @error('form.status')
                <x-input-error class="mt-2" :messages="$message"/>
                @enderror
            </div>
    </div>

</div></div>

