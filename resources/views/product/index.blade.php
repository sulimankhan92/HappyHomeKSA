<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>products</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" href="{{ route('products.create') }}" >Add new</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid basic_table">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
                    <x-alert />
                    <div class="card-header text-end">
                        <h3 class="text-start">products List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchProduct($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>

                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
{{--                                <th>No</th>--}}
                                <th>Product</th>
                                <th>Category</th>
                                <th>Name En</th>
                                <th>Name Ar</th>
                                <th>Description</th>
                                <th>Description</th>
                                <th>Manufacture</th>
{{--                                <th>Warehouse</th>--}}
                                <th>Supplier</th>
{{--                                <th>Creator</th>--}}
                                <th>Order</th>
                                <th>Box Size</th>
                                <th>Barcode</th>
                                <th>Location</th>
                                <th>Action</th>
                                <th>Country</th>
                                <th>Status</th>
                                <th>Min - Max</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                <tr wire:key="{{ $product->id }}">
{{--                                    <td>{{ ++$i }}</td>--}}
                                    <td>
                                        <a href="#">
                                            <img src=" {{ asset('/assets/images/ecommerce/product-table-1.png') }}" alt="">
                                        </a>
                                    </td>
                                    <td>{{ $product->name_en }}</td>
                                    <td>{{ $product->name_ar }}</td>
                                    <td>{{ $product->description_en }}</td>
                                    <td>{{ $product->description_ar }}</td>
                                    <td>{{ optional($product)->secondaryCategories->name_en }}</td>
                                    <td>{{ $product->productManufacturer->name_en }}</td>
{{--                                    <td>{{ $product->product_warehouse_id }}</td>--}}
                                    <td>{{ $product->supplier->name }}</td>
{{--                                    <td>{{ $product->user->name }}</td>--}}
                                    <td>{{ $product->order }}</td>
                                    <td>{{ $product->box_size }}</td>
                                    <td>{{ $product->barcode }}</td>
                                    <td>{{ $product->product_location }}</td>

                                    <td>
                                        <a wire:navigate href="{{ route('products.show', $product->id) }}"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('products.edit', $product->id) }}"><i class="fas fa-pencil-alt"></i></a>
                                        <a wire:navigate href="{{ route('product-variants.add-variants',  $product->id) }}"><i class="fa fa-shopping-basket me-1"></i></a>
                                    </td>
                                    <td>{{ optional($product->country)->name_en }}</td>
                                    <td>{{ $product->getStatusOptions()[$product->status] }}</td>
                                    <td>{{ $product->min_purchase .' - '.$product->max_purchase }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $products->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
