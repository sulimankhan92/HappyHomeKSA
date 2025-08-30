<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Product Packing</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" wire:navigate  href="{{ route('product-packings.create') }}" >Add new</a>
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
                        <h3 class="text-start">Packing List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchProductPackings($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>

                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Packaging Level</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Conversion Rate</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($productPackings as $productPacking)
                                <tr wire:key="{{ $productPacking->id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $productPacking->packaging_level }}</td>
                                    <td>{{ $productPacking->quantity }}</td>
                                    <td>{{ $productPacking->conversion_rate }}</td>
                                    <td>{{ $productPacking->user->name }}</td>
                                    <td>
                                        <p class="text-{{ $productPacking->status ? 'success' : 'danger' }}">
                                            {{ $productPacking->getStatusOptions()[$productPacking->status] }}
                                        </p>
                                    </td>
                                    <td>
                                        <a wire:navigate href="{{ route('product-packings.show', $productPacking->id) }}"><i class="fa fa-eye"></i></a>
                                        <a wire:navigate href="{{ route('product-packings.edit', $productPacking->id) }}"><i class="fas fa-pencil-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $productPackings->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
