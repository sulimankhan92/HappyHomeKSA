<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>{{ __('Product Brands') }}</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" href="{{ route('productBrands.create') }}" >Add new</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid basic_table">
        <div class="row">
            <div class="col-sm-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">

                    <div class="card-header text-end">
                        <h3 class="text-start">product brands</h3>
                        <div id="basic-1_filter" class="dataTables_filter">
                            <label>Search:<input type="search"  placeholder=""  aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;">
                            </label>
                        </div>
                    </div>

                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Name ar</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($productBrands as $productBrand)
                                <tr class="even:bg-gray-50" wire:key="{{ $productBrand->id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>
                                        <img width="80px"
                                             src="{{ asset('storage/brands/' . $productBrand->logo) }}"
                                             alt="Product Image">
                                    </td>
                                    <td>{{ $productBrand->name }}</td>
                                    <td>{{ $productBrand->name_ar }}</td>
                                    <td>
                                        <p class="text-{{ $productBrand->status ? 'success' : 'danger' }}">
                                            {{ $productBrand->getStatusOptions()[$productBrand->status] }}
                                        </p>
                                        </td>
                                    <td>
{{--                                        <a wire:navigate href="{{ route('product-brands.show', $productBrand->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">{{ __('Show') }}</a>--}}
                                        <a wire:navigate href="{{ route('productBrands.edit', $productBrand->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900  mr-2">{{ __('Edit') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $productBrands->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
