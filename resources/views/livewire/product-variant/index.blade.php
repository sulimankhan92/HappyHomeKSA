<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>{{ __('Product Variants') }}</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" wire:navigate href="{{ route('product-variants.create') }}">Add new</a>
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
                        <h3 class="text-start">{{ __('Product Variants') }} List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchProductVariant($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>
                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Product Id</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Unit Id</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Expiry Date</th>
                                <th scope="col">Expiry Date Alerts</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($productVariants as $productVariant)
                                <tr wire:key="{{ $productVariant->id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $productVariant->product_id }}</td>
                                    <td>{{ $productVariant->created_by }}</td>
                                    <td>{{ $productVariant->unit_id }}</td>
                                    <td>{{ $productVariant->weight }}</td>
                                    <td>{{ $productVariant->quantity }}</td>
                                    <td>{{ $productVariant->expiry_date }}</td>
                                    <td>{{ $productVariant->expiry_date_alerts }}</td>
                                    <td>{{ $productVariant->status }}</td>
                                    <td>
                                        <a wire:navigate href="{{ route('product-variants.show', $productVariant->id) }}">{{ __('Show') }}</a>
                                        <a wire:navigate href="{{ route('product-variants.edit', $productVariant->id) }}">{{ __('Edit') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $productVariants->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
