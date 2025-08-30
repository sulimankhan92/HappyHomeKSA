<x-app-layout>
    <div class="page-body">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="container-fluid" style="padding-top: 24px;">
            <div class="row">

                <div class="col-xxl-2 col-xl-3 box-col-3e">
                    <div class="md-sidebar">
                        <div class="md-sidebar-aside job-sidebar">
                            <div class="default-according style-1 faq-accordion job-accordion" id="accordionoc">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseicon" aria-expanded="true" aria-controls="collapseicon">Create New Variant</button>
                                                </h5>
                                            </div>
                                            <div class="collapse show" id="collapseicon" aria-labelledby="collapseicon" data-bs-parent="#accordion">
                                                <div class="card-body filter-cards-view animate-chk">
                                                    <p>Product : {{ $product[0]->name_en }}</p>
                                                    <form class="form theme-form dark-inputs" method="POST" action="{{ route('product-variants.store') }}" id="frm-stock-in" >
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="product_id" value="{{ $product[0]->id }}">
                                                        <div class="job-filter mb-2">
                                                            <div class="faq-form">
                                                                <div class="input-group">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" name="weight" type="number"  value="{{ old('weight') }}" step="0.01">
                                                                        <label for="floatingInputGroup1">Weight / Size</label>
                                                                    </div>
                                                                </div>
                                                                @error('weight')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="job-filter mb-2">
                                                            <div class="faq-form">
                                                                <div class="form-floating">
                                                                    <select id="unit_id" name="unit_id" class="form-select" id="floatingSelectGrid">
                                                                        @foreach(App\Models\Unit::all() as $key => $unit)
                                                                            <option value="{{ $unit->id }}"  {{ old('unit_id', $product_variant?->unit_id) == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <label for="floatingSelectGrid">Select Unit</label>
                                                                </div>
                                                                {{--                                                            <input class="form-control" type="text" placeholder="location.."><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin search-icon"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>--}}
                                                            </div>
                                                        </div>
                                                        <div class="job-filter mb-2">
                                                            <div class="faq-form">
                                                                <div class="input-group">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" name="purchase_price" type="number" value="{{ old('purchase_price') }}" step="0.01" min="0">
                                                                        <label for="floatingInputGroup1">Purchase Price</label>
                                                                    </div>
                                                                </div>
                                                                @error('purchase_price')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="job-filter mb-2">
                                                            <div class="faq-form">
                                                                <div class="input-group">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" name="sale_price" type="number" value="{{ old('sale_price') }}" step="0.01" min="0">
                                                                        <label for="floatingInputGroup1">Sale Price</label>
                                                                    </div>
                                                                </div>
                                                                @error('sale_price')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="job-filter mb-2">
                                                            <div class="faq-form">
                                                                <div class="input-group">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" name="expiry_date_alerts" type="number" value="{{ old('expiry_date_alerts') }}">
                                                                        <label for="floatingInputGroup1">Expiry Date Alerts (Days)</label>
                                                                    </div>
                                                                </div>
                                                                @error('expiry_date_alerts')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="job-filter mb-2">
                                                            <div class="faq-form">
                                                                <div class="input-group">
                                                                    <div class="form-floating">
                                                                        <input class="form-control" name="quantity_alerts" type="number" value="{{ old('quantity_alerts') }}">
                                                                        <label for="floatingInputGroup1">Quantity Alerts</label>
                                                                    </div>
                                                                </div>
                                                                @error('quantity_alerts')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="job-filter mb-2">
                                                            <div class="faq-form">
                                                                <div class="form-floating">
                                                                    <select id="status" name="status" class="form-select" id="floatingSelectGrid">
                                                                        @foreach(App\Models\ProductVariant::getStatusOptions() as $key => $status)
                                                                            <option value="{{ $key }}" {{ old('status', $product_variant?->status) == $key ? 'selected' : '' }}>{{ $status }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <label for="floatingSelectGrid">Select Status</label>
                                                                </div>
                                                                @error('status')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary text-center">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-10 col-xl-9 box-col-9">
                    @if(isset($product_variants) && $product_variants->isNotEmpty())
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="order-history table-responsive theme-scrollbar wishlist">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                        <form class="form theme-form dark-inputs" method="POST" action="{{ route('product-variants.store_packing') }}" id="frm-stock-in" >
                                                            @csrf
                                                            @method('POST')
                                                            <input type="hidden" name="product_id" value="{{ $product[0]->id }}">
                                                            <tr>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <div class="form-floating">
                                                                            <select id="product_variant_id" name="product_variant_id" class="form-select" id="floatingSelectGrid">
                                                                                <option>Select Variant</option>
                                                                                @foreach($product_variants as $key => $variant)
                                                                                    <option value="{{ $variant->id }}">{{ $variant->weight.' '.$variant->unit->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <label for="floatingSelectGrid">Select Variant</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <div class="form-floating">
                                                                            <select id="product_packaging_id" name="product_packaging_id" class="form-select" id="floatingSelectGrid">
                                                                                <option>Select Packing</option>
                                                                                @foreach($product_packing as $packing)
                                                                                    <option value="{{ $packing->id }}">{{ $packing->packaging_level }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <label for="floatingSelectGrid">Select Packing</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <div class="form-floating">
                                                                            <input class="form-control" name="old_price" type="number" step="0.01" min="0">
                                                                            <label for="floatingInputGroup1">First Price</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <div class="form-floating">
                                                                            <input class="form-control" name="price" type="number" step="0.01" min="0">
                                                                            <label for="floatingInputGroup1">Last Price</label>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-floating">
                                                                        <select id="status" name="status" class="form-select" id="floatingSelectGrid">
                                                                            @foreach(App\Models\ProductVariant::getStatusOptions() as $key => $status)
                                                                                <option value="{{ $key }}" {{ old('status', $product_variant?->status) == $key ? 'selected' : '' }}>{{ $status }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <label for="floatingSelectGrid">Select Status</label>
                                                                    </div>
                                                                </td>
                                                                <td><input  type="submit" class="btn btn-success cart-btn-transform"></td>
                                                            </tr>
                                                        </form>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Container-fluid Ends-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach($product_variants as $key => $variant)
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="order-history table-responsive theme-scrollbar wishlist">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>Weight</th>
                                                                <th>Purchase - Sale</th>
                                                                <th>Stock</th>
                                                                <th>Expiry</th>
                                                                <th>Expiry Alerts - Qty Alerts</th>
                                                                <th>Status</th>
                                                                <th>Edit</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td><b>{{ $variant->weight.' '.$variant->unit->name }}</b></td>
                                                                <td>{{ $variant->purchase_price }} - {{ $variant->sale_price }}</td>
                                                                <td>{{ $variant->quantity }}</td>
                                                                <td>{{ $variant->expiry_date }}</td>
                                                                <td>{{ $variant->expiry_date_alerts }} - {{ $variant->quantity_alerts }}</td>
                                                                <td>{{ $variant->getStatusOptions()[$variant->status] }}</td>
                                                                <td>
                                                                    <a type="button" class="btn-variant-edit" data-id="{{ $variant->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                                    <a href="{{ route('products.histories', $variant) }}"><i style="font-size:20px;" class="fa fa-history text-info" aria-hidden="true"></i></a>
                                                                </td>
                                                            </tr>
                                                            @if($variant->productDetails->isNotEmpty())
                                                                <tr style="background-color: #d6e3ee;">
                                                                    <th>S.No</th>
                                                                    <th>Packing</th>
                                                                    <th>Per Pack Qty</th>
                                                                    <th>First Price</th>
                                                                    <th>Last Price</th>
                                                                    <th>Status</th>
                                                                    <th>Edit</th>
                                                                </tr>
                                                                @foreach($variant->productDetails as $productDetails)
                                                                    <tr>
                                                                        <td></td>
                                                                        <td>{{ $productDetails->productPacking->packaging_level }}</td>
                                                                        <td>{{ $productDetails->productPacking->quantity }}</td>
                                                                        <td><span><s>{{ $productDetails->old_price }}</s></span></td>
                                                                        <td> {{ $productDetails->price }}</td>
                                                                        <td>{{ $productDetails->getStatusOptions()[$productDetails->status] }}</td>
                                                                        <td>
                                                                            <a type="button" class="btn-edit" data-id="{{ $productDetails->id }}"><i class="fas fa-pencil-alt"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Container-fluid Ends-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>

        <!-- Edit Product Variant Modal -->
        <div class="modal fade" id="editProductVariantModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('product-variants.update') }}" id="frm-edit-product-details">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="product_variant_id" id="edit_product_variant_id" value="">
                        <input type="hidden" name="product_id" value="{{ $product[0]->id }}">

                        <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel">Edit Product Details</h5>
                        </div>

                        <div class="modal-body">
                            <!-- Packaging Level -->
                            <div class="form-group">
                                <label for="old_price">Weight</label>
                                <input type="number" class="form-control" name="weight" id="edit_weight">
                            </div>
                            <div class="form-group">
                                <label for="product_packaging_id">Packaging Level</label>
                                <select id="edit_unit_id" name="unit_id" class="form-select" id="floatingSelectGrid">
                                    @foreach(App\Models\Unit::all() as $key => $unit)
                                        <option value="{{ $unit->id }}"  {{ old('unit_id', $product_variant?->unit_id) == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="purchase_price">Purchase Price</label>
                                <input type="number" class="form-control" name="purchase_price" id="purchase_price"  step="0.01" min="0">
                            </div>
                            <div class="form-group">
                                <label for="sale_price">Sale Price</label>
                                <input type="number" class="form-control" name="sale_price" id="sale_price"  step="0.01" min="0">
                            </div>
                            <!-- Old Price -->
                            <div class="form-group">
                                <label for="expiry_date_alerts">Expiry Date Alerts</label>
                                <input type="number" class="form-control" name="expiry_date_alerts" id="edit_expiry_date_alerts">
                            </div>
                            <!-- Old Price -->
                            <div class="form-group">
                                <label for="expiry_date">Expiry Date</label>
                                <input type="date" class="form-control" name="expiry_date" id="expiry_date">
                            </div>
                            <!-- Price -->
                            <div class="form-group">
                                <label for="price">Quantity Alerts</label>
                                <input type="number" class="form-control" name="quantity_alerts" id="edit_quantity_alerts">
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="edit_status_packing" name="status" class="form-control">
                                    @foreach(App\Models\ProductVariant::getStatusOptions() as $key => $status)
                                        <option value="{{ $key }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Product Packing Modal -->
        <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('product-details.update') }}" id="frm-edit-product-details">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="product_detail_id" id="product_detail_id" value="">
                        <input type="hidden" name="product_id" value="{{ $product[0]->id }}">

                        <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel">Edit Product Details</h5>
                        </div>

                        <div class="modal-body">
                            <!-- Packaging Level -->
                            <div class="form-group">
                                <label for="product_packaging_id">Packaging Level</label>
                                <select id="edit_product_packaging_id" name="product_packaging_id" class="form-control">
                                    @foreach($product_packing as $packing)
                                        <option value="{{ $packing->id }}">{{ $packing->packaging_level }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Old Price -->
                            <div class="form-group">
                                <label for="old_price">First Price</label>
                                <input type="number" class="form-control" name="old_price" id="edit_old_price"  step="0.01" min="0">
                            </div>
                            <!-- Price -->
                            <div class="form-group">
                                <label for="price">Last Price</label>
                                <input type="number" class="form-control" name="price" id="edit_price"  step="0.01" min="0">
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="edit_status" name="status" class="form-control">
                                    @foreach(App\Models\ProductVariant::getStatusOptions() as $key => $status)
                                        <option value="{{ $key }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).on('click', '.btn-variant-edit', function() {
                var id = $(this).data('id');

                $('#editProductVariantModal').modal('show');
                $('#edit_weight').val('');
                $('#edit_unit_id').val('');
                $('#edit_status_packing').val('');
                $('#edit_expiry_date_alerts').val('');
                $('#edit_quantity_alerts').val('');
                $.ajax({
                    url: '/product-variants/edit_details/' + id, // URL now matches the route
                    method: 'GET',
                    success: function(data) {
                        $('#edit_product_variant_id').val(data.id);
                        $('#edit_weight').val(data.weight);
                        $('#edit_unit_id').val(data.unit_id);
                        $('#purchase_price').val(data.purchase_price);
                        $('#sale_price').val(data.sale_price);
                        $('#edit_status_packing').val(data.status);
                        $('#edit_expiry_date_alerts').val(data.expiry_date_alerts);
                        $('#edit_quantity_alerts').val(data.quantity_alerts);
                        $('#expiry_date').val(data.expiry_date);
                    }
                });
            });

            $(document).on('click', '.btn-edit', function() {
                var id = $(this).data('id');

                $('#editProductModal').modal('show');
                $('#edit_product_packaging_id').val('');
                $('#edit_price').val('');
                $('#edit_old_price').val('');
                $('#edit_status').val('');
                $.ajax({
                    url: '/product-details/edit_details/' + id, // URL now matches the route
                    method: 'GET',
                    success: function(data) {
                        $('#product_detail_id').val(data.id);
                        $('#edit_product_packaging_id').val(data.product_packaging_id);
                        $('#edit_price').val(data.price);
                        $('#edit_old_price').val(data.old_price);
                        $('#edit_status').val(data.status);
                    }
                });
            });
        </script>

    </div>
</x-app-layout>

