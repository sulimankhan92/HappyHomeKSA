<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Product Manufacturers</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" wire:navigate href="{{ route('product-manufacturers.create') }}" >Add new</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid basic_table">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">

                    <div class="card-header text-end">
                        <h3 class="text-start">Manufacturers List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchProductManufacturer($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>

                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name En</th>
                                <th scope="col">Name Ar</th>
                                <th scope="col">Country</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Description En</th>
                                <th scope="col">Description Ar</th>
                                <th scope="col">Logo</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($productManufacturers as $productManufacturer)
                                <tr wire:key="{{ $productManufacturer->id }}" wire:loading.class="opacity-25">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $productManufacturer->name_en }}</td>
                                    <td>{{ $productManufacturer->name_ar }}</td>
                                    <td>{{ optional($productManufacturer->country)->name_en }}</td>
                                    <td>{{ optional($productManufacturer->user)->name }}</td>
                                    <td>{{ $productManufacturer->description_en }}</td>
                                    <td>{{ $productManufacturer->description_ar }}</td>
                                    <td>{{ $productManufacturer->logo }}</td>
                                    <td>
                                        <p class="text-{{ $productManufacturer->status ? 'success' : 'danger' }}">
                                            {{ $productManufacturer->getStatusOptions()[$productManufacturer->status] }}
                                        </p>
                                    </td>
                                    <td>
                                        <a wire:navigate href="{{ route('product-manufacturers.show', $productManufacturer->id) }}"><i class="fa fa-eye"></i></a>
                                        <a wire:navigate href="{{ route('product-manufacturers.edit', $productManufacturer->id) }}"><i class="fas fa-pencil-alt"></i></a>
                                        {{--                                        <button--}}
                                        {{--                                            type="button"--}}
                                        {{--                                            wire:click="delete({{ $productManufacturer->id }})"--}}
                                        {{--                                            wire:confirm="Are you sure you want to delete?"--}}
                                        {{--                                        >--}}
                                        {{--                                            {{ __('Delete') }}--}}
                                        {{--                                        </button>--}}
                                    </td>
                                </tr>
                            @endforeach
                            <tr><td colspan="10"></td></tr>
                            </tbody>
                        </table>
                        {!! $productManufacturers->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
