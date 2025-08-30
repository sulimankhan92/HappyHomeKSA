<x-app-layout>
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6 ps-0">
                        <h3>products</h3>
                    </div>
                    <div class="col-sm-6 pe-0  text-end">
                        <!--<a class="btn btn-primary" href="{{ route('products.create') }}" >Add new</a>-->
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
                                    <th>Name</th>
                                    <th>Weight</th>
                                    <th>Qty in Stock</th>
                                    <th>Alerts</th>
                                    {{--                                <th>Manufacture</th>--}}
                                    {{--                                <th>Warehouse</th>--}}
                                    {{--                                <th>Supplier</th>--}}
                                    {{--                                <th>Creator</th>--}}
                                    {{--                                <th>Order</th>--}}
                                    {{--                                <th>Box Size</th>--}}
                                    <th>Barcode</th>
                                    {{--                                <th>Location</th>--}}
                                    {{--                                <th>Action</th>--}}
                                    {{--                                <th>Country</th>--}}
                                    <th>Status</th>
                                    <th>Min - Max</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($product_variants as $product_variant)
                                    <tr @if($product_variant->quantity == 0) style="background: #f2dede;" @endif>
                                        <td>
                                            <img width="80px"
                                                 src="{{ optional($product_variant->product->productImages->first())->file_name ? asset('storage/products/' . optional($product_variant->product->productImages->first())->file_name) : asset('storage/products/default.png') }}"
                                                 alt="Product Image">
                                        </td>
                                        <td>{{ $product_variant->product->name_en }}</td>
                                        <td>{{ $product_variant->weight .' '.$product_variant->unit->name }}</td>
                                        <td style="color: #f41f49;">{{ $product_variant->quantity }}</td>
                                        <td>{{ $product_variant->quantity_alerts }}</td>
                                        {{--                                    <td>{{ optional($product_variant->product)->secondaryCategories->name_en }}</td>--}}
                                        {{--                                    <td>{{ $product_variant->product->productManufacturer->name_en }}</td>--}}
                                        {{--                                    <td>{{ $product_variant->product->supplier->name }}</td>--}}
                                        {{--                                    <td>{{ $product_variant->product->order }}</td>--}}
                                        {{--                                    <td>{{ $product_variant->product->box_size }}</td>--}}
                                        <td>{{ $product_variant->product->barcode }}</td>
                                        {{--                                    <td>{{ $product_variant->product->product_location }}</td>--}}
                                        {{--                                    <td>--}}
                                        {{--                                        <a wire:navigate href="{{ route('products.show', $product->id) }}"><i class="fa fa-eye"></i></a>--}}
                                        {{--                                        <a href="{{ route('products.edit', $product->id) }}"><i class="fas fa-pencil-alt"></i></a>--}}
                                        {{--                                        <a wire:navigate href="{{ route('product-variants.add-variants',  $product->id) }}"><i class="fa fa-shopping-basket me-1"></i></a>--}}
                                        {{--                                    </td>--}}
                                        {{--                                    <td>{{ optional($product_variant->product->country)->name_en }}</td>--}}
                                        <td>{{ $product_variant->product->getStatusOptions()[$product_variant->product->status] }}</td>
                                        <td>{{ $product_variant->product->min_purchase .' - '.$product_variant->product->max_purchase }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--                        {!! $product_variant->->links('vendor.pagination.custom') !!}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
</x-app-layout>
