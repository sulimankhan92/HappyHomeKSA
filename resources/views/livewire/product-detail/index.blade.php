<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Product Details</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" wire:navigate href="{{ route('product-details.create') }}" >Add new</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="order-history table-responsive theme-scrollbar wishlist">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Prdouct</th>
                                        <th>Prdouct Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Action</th>
                                        <th>Action</th>
                                        <th>Action</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($productDetails as $productDetail)
                                        <tr wire:key="{{ $productDetail->id }}">
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $productDetail->product_variant_id }}</td>
                                            <td>{{ $productDetail->product_packaging_id }}</td>
                                            <td>{{ $productDetail->created_by }}</td>
                                            <td>{{ $productDetail->price }}</td>
                                            <td>{{ $productDetail->quantity_to_show_alerts }}</td>
                                            <td>{{ $productDetail->status }}</td>
                                            <td>
                                                <a wire:navigate href="{{ route('product-details.show', $productDetail->id) }}"><i class="fa fa-eye"></i></a>
                                                <a wire:navigate href="{{ route('product-details.edit', $productDetail->id) }}"><i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="6">
                                            <div class="input-group">
                                                <input class="form-control me-2" type="text" placeholder="Enter coupan code"><a class="btn btn-primary" href="#">Apply</a>
                                            </div>
                                        </td>
                                        <td class="total-amount">
                                            <h3 class="m-0 text-end"><span class="f-w-600">Total Price :</span></h3>
                                        </td>
                                        <td><span>$6935.00  </span></td>
                                    </tr>
                                    <tr>
                                        <td class="text-end" colspan="7">
                                            <a class="btn btn-secondary cart-btn-transform" href="#">Hide Showing</a>
                                        </td>
                                        <td><a class="btn btn-success cart-btn-transform" href="#">Display Now</a></td>
                                    </tr>
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
