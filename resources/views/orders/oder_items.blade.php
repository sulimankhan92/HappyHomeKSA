<x-app-layout>
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6 ps-0">
                        <h3>Order</h3>
                    </div>
                    <div class="col-sm-6 pe-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">
                                    <svg class="stroke-icon">
                                        <use href="https://admin.pixelstrap.com/cion/assets/svg/icon-sprite.svg#stroke-home"></use>
                                    </svg></a></li>
                            <li class="breadcrumb-item">Order</li>
                            <li class="breadcrumb-item active">Items</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card">
                        {{--                    <div class="card-header">--}}
                        {{--                        <h3>Items</h3>--}}
                        {{--                    </div>--}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 xl-100 col-sm-12 mb-2">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img class="me-3 rounded-circle" src="{{ asset('assets/images/user/user.png') }}" alt="">
                                            <div>
                                                <h3 class="p-0">
                                                    {{ $order->customer->name }}
                                                    <small>{{ optional($order)->deliveryDay->name_en ?? '' }} - {{ optional($order)->deliveryTime->time_slot ?? '' }}</small>
                                                </h3>
                                                <p>{{ optional($order)->deliveryAddress->address ?? '' }}</p>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary ms-3" type="button" onclick="toggleAddProduct()">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="row add_new_product"  style="display: none;">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header pb-0">
                                            </div>
                                            <form class="form theme-form dark-inputs" method="POST" action="{{ route('order.add_line_item_to_otder') }}" id="frm-add-new-item" >
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="order_id" value="{{ $order->id  }}">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="search-prod">Find/Scan Product</label>
                                                            <select id="product_id" class="form-control product_id" name="product_id">
                                                                <option value="">Select Product</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="">Variants</label>
                                                            <select id="variant_id" name="variant_id" class="form-control variant_id">
                                                                <option value="">Select Product</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for="">Packing</label>
                                                            <select id="product_details_id" name="product_details_id" class="form-control product_details_id">
                                                                <option value="">Select Packing</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label for="">Price</label>
                                                            <input
                                                                type="text"
                                                                id="price"
                                                                class="form-control price"
                                                                placeholder="price"
                                                                value=""
                                                                name="price" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label for="">Qty</label>
                                                            <input
                                                                type="number"
                                                                id="quantity"
                                                                class="form-control quantity"
                                                                placeholder="QTY"
                                                                value=""
                                                                name="quantity">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label for=""></label>
                                                            <a class="btn btn-primary add-stock-to-list" style="margin-top: 30px;padding: 0.75rem 2rem;"  > <i class="fa fa-paper-plane"></i>  Add New Item </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <span class="f-m-light mt-1 text-danger error-message"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-block row">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive theme-scrollbar">
                                                    <table class="table table-dashed">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Payment </th>
                                                            <th scope="col">Tax</th>
                                                            <th scope="col">Discount</th>
                                                            <th scope="col">Delivery Cost</th>
                                                            <th scope="col">Wallet Points</th>
                                                            <th scope="col">Total</th>
                                                            <th scope="col">Paid</th>
                                                            <th scope="col">Un Paid</th>
                                                            <th scope="col">Wallet Refund</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Time Ago</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <tr>
                                                            <td>
                                                                {{ optional($order)->paymentMethod->name_en ?? 'Null' }}
                                                            </td>
                                                            <td>{{ $order->total_tax }}</td>
                                                            <td>{{ $order->total_discount }}</td>
                                                            <td>{{ $order->delivery_cost }}</td>
                                                            <td>{{ $order->wallet_points }}</td>
                                                            <td>{{ $order->total_amount }}</td>
                                                            <td>{{ $order->total_amount_paid }}</td>
                                                            <td>{{ $order->total_amount_unpaid }}</td>
                                                            <td>
                                                                {{ $order->wallet_points_refund }}
                                                                @php
                                                                    $formattedDate = \Carbon\Carbon::parse($order->created_at)->format('(d F) g:i A');
                                                                    $timeAgo = \Carbon\Carbon::parse($order->created_at)->diffForHumans();
                                                                @endphp
                                                                {{-- {{ $formattedDate }} --}}
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-{{ $order->status == 1 ? 'primary' : ($order->status == 2 ? 'info' : ($order->status == 3 ? 'warning' : ($order->status == 7 ? 'warning' : ($order->status == 8 ? 'danger' : 'dark')))) }} btn-xs">
                                                                    {{ $order->getStatusOptions()[$order->status] }}
                                                                </a>
                                                            </td>
                                                            <td>{{ $timeAgo }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="order-history table-responsive theme-scrollbar wishlist">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Name</th>
                                            <th>Packaging</th>
                                            <th>status</th>
                                            <th>Canceled</th>
                                            <th>Quantity</th>
                                            <th>Price </th>
                                            <th>Tax</th>
                                            <!--<th>Unit Price</th>-->
                                            <!--<th>Total Tax</th>-->
                                            <th>Total</th>
                                            <th>Cancel</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <form method="POST" action="{{ route('order.update_order_quantity') }}" role="form" enctype="multipart/form-data">
                                            @csrf
                                            @php
                                                $priceTotalWithTax = 0;
                                                $priceTotal = 0;
                                                $priceTax = 0;
                                                $priceTotalWithOutTax = 0;
                                                $itemstotalQty = 0;
                                            @endphp

                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            @foreach($order->orderItems as $item)
                                                @php
                                                    $priceDetails = $item->get_original_price($item->price);

                                                    if($item->status != 8){
                                                        $priceTotalWithTax += $item->price * $item->quantity;
                                                        $priceTotalWithOutTax +=  $item->discounted_tax;
                                                        $priceTotal += $item->item_subtotal;
                                                        $priceTax += $item->discounted_price;

                                                        $itemstotalQty += $item->quantity;
                                                    }

                                                @endphp
                                                <tr style="background-color: {{ $item->status == 8 ? '#fec0bafa' : '' }};">
                                                    <td>
                                                        <img class="img-fluid img-80"
                                                             src="{{ optional( $item->productDetail->productVariant->product->productImages->first())->file_name ? asset('storage/products/' . optional( $item->productDetail->productVariant->product->productImages->first())->file_name) : asset('storage/products/default.png') }}"
                                                             alt="#">
                                                    </td>
                                                    <td>
                                                        <div class="product-name">
                                                            <a href="#">
                                                                {{ $item->productDetail->productVariant->product->name_en }}<br>
                                                                <b>{{ $item->productDetail->productVariant->weight }} {{ $item->productDetail->productVariant->unit->name }}</b>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->productDetail->productPacking->packaging_level }}</td>
                                                    <td><a class="btn btn-primary btn-xs">{{ $item->getStatusOptions()[$item->status] }}</a></td>
                                                    <td>{{ $item->qty_cancelled }}</td>
                                                    <td>
                                                        <fieldset class="qty-box">
                                                            <input type="hidden" id="original-qty-{{ $item->id }}" value="{{ $item->quantity }}">
                                                            <div class="input-group bootstrap-touchspin" style="{{ $item->status == 8 ? 'opacity: 0.6; pointer-events: none;' : '' }}">
                                                                <button class="btn btn-primary btn-square bootstrap-touchspin-down"
                                                                        type="button"
                                                                        onclick="{{ $item->status != 8 ? 'decrementQuantity('.$item->id.', '.$item->quantity.')' : 'return false;' }}"
                                                                    {{ $item->status == 8 ? 'disabled' : '' }}>
                                                                    <i class="fa fa-minus"></i>
                                                                </button>

                                                                <input class="text-center form-control"
                                                                       type="number"
                                                                       name="quantities[{{ $item->id }}]"
                                                                       id="quantity-{{ $item->id }}"
                                                                       value="{{ $item->quantity }}"
                                                                       min="1"
                                                                       style="display: block;"
                                                                       {{ $item->status == 8 ? 'disabled' : '' }}
                                                                       readonly>

                                                                <button class="btn btn-primary btn-square bootstrap-touchspin-up"
                                                                        type="button"
                                                                        onclick="{{ $item->status != 8 ? 'incrementQuantity('.$item->id.', '.$item->productDetail->productVariant->quantity.')' : 'return false;' }}"
                                                                    {{ $item->status == 8 ? 'disabled' : '' }}>
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </div>
                                                        </fieldset>
                                                    </td>

                                                    <td> {{ $priceDetails[0] }}</td>
                                                    <td> {{ $priceDetails[1] }}</td>
                                                    <td>{{ $item->item_subtotal }}</td>
                                                    <!--<td> {{ $priceDetails[1] * $item->quantity  }}</td>-->

                                                    <!--<td>{{ $item->price * $item->quantity }} </td>-->
                                                    <td>
                                                        @if($item->status == 8)
                                                            <span class="disabled-icon" title="Item already canceled">
                                                                <i class="font-danger" data-feather="x-circle"></i>
                                                            </span>
                                                        @else
                                                            <a href="{{ route('order-items.update_status', [$item->id, 2]) }}"
                                                               onclick="return confirmOrderCanceled()"
                                                               class="cancel-item-link"
                                                               title="Cancel this item">
                                                                <i class="font-danger" data-feather="x-circle"></i>
                                                            </a>
                                                        @endif
                                                        <!--<i class="font-danger" data-feather="x-circle"></i>-->
                                                        <!--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle font-success">-->
                                                        <!--    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>-->
                                                        <!--    <polyline points="22 4 12 14.01 9 11.01"></polyline>-->
                                                        <!--</svg>-->
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4">
                                                    <div class="input-group">
                                                        <div class="d-flex mt-2">
                                                            <input id="coupon_code_input" class="form-control me-2" type="text" placeholder="Enter coupon code" >
                                                            <button type="button" class="btn btn-primary" onclick="applyCoupon('{{ $item->order_id }}')">Apply</button>
                                                        </div>
                                                        <div id="coupon-response-{{ $item->order_id }}" class="mt-2 text-success"></div>
                                                    </div>
                                                </td>

                                                <td class="total-amount"  colspan="1">
                                                    <h3 class="m-0 text-end"><span class="f-w-600">Total :</span></h3>
                                                </td>
                                                <td><span>{{ $itemstotalQty }} </span></td>
                                                <td><span>{{ $priceTax }} </span></td>
                                                <td><span>{{ $priceTotalWithOutTax }} </span></td>
                                                <td><span>{{ $priceTotal }} </span></td>
                                                <!--<td><span> </span></td>-->

                                                <!--<td><span>{{ $priceTotalWithTax }} </span></td>-->
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="text-end"  colspan="3">
                                                    <a class="btn btn-danger" onclick="return confirmOrderCanceled()" href="{{ route('orders.update_status', [$order->id, 0]) }}">
                                                        <i class="fa fa-times"></i> Canceled
                                                    </a>
                                                </td>
                                                <td class="text-end" colspan="2">
                                                    <button type="submit" class="btn btn-primary cart-btn-transform"  onclick="return confirmUpdateQuantity()">
                                                        <i class="fas fa-sync"></i> Update Qty
                                                    </button>
                                                </td>
                                        </form>
                                        <td colspan="3">
                                            <form method="POST" action="{{ route('order.update_order_status') }}" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                <input type="hidden" name="status" value="{{ $order->status }}">
                                                <input type="hidden" name="new_status" value="{{ $order->getNextStatus($order->status) }}">

                                                @php
                                                    $nextStatus = $order->getNextStatus($order->status);
                                                    $buttonClass = '';
                                                    $icon = '';

                                                    switch ($nextStatus) {
                                                        case 2:
                                                            $buttonClass = 'btn-info';
                                                            $icon = '<i class="fas fas fa-spinner"></i>';
                                                            break;
                                                        case 3:
                                                            $buttonClass = 'btn-warning';
                                                             $icon = '<i class="fas fa-truck"></i>';
                                                            break;
                                                        case 7:
                                                            $buttonClass = 'btn-danger';
                                                            $icon = '<i class="fas fa-box-open"></i>';
                                                            break;
                                                        case 8:
                                                            $buttonClass = 'btn-danger';
                                                            break;
                                                        default:
                                                            $buttonClass = 'btn-dark';
                                                    }
                                                    $shouldDisable = ($order->status == 1 && empty($order->user_order_collected_by)) || ($order->status == 2 && empty($order->user_order_delivered_by));

                                                @endphp
                                                @if ($order->status != 4 && $order->status != 9 && $order->status != 8)
                                                    <button type="submit" class="btn {{ $buttonClass }} cart-btn-transform" {{ $shouldDisable ? 'disabled' : '' }}
                                                    onclick="return confirmUpdateStatus()"
                                                    >
                                                        {!! $icon !!} {{ $order  ? $order->getStatusOptions()[$nextStatus] : 'No Next Status' }}
                                                    </button>
                                                @else
                                                    <a class="btn btn-close cart-btn-transform">Completed</a>
                                                @endif
                                            </form>
                                        </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-block row">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive theme-scrollbar">
                                                    <table class="table table-dashed">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col">Manager </th>
                                                            <th scope="col">Collector </th>
                                                            <th scope="col">Captain </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <form method="POST" action="{{ route('order.assigned_order_to_user') }}" role="form" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="order_id" value="{{ $order->id  }}">
                                                            <tr>
                                                                <td>{{  optional($order)->orderManager->name ?? '' }}</td>
                                                                <td>{{  optional($order)->orderCollector->name ?? '' }}</td>
                                                                <td>{{  optional($order)->deliveryCaptain->name ?? '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <div>
                                                                        <select class="form-select input-air-primary" name="collector_id" id="search_collector">
                                                                            <option value="">Select a user</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <select class="form-select input-air-primary" name="captain_id" id="search_captain">
                                                                            <option value="">Select a user</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-end" colspan="8">
                                                                    <input type="submit" class="btn btn-success cart-btn-transform" value="Assigned Collector / Captain">
                                                                </td>
                                                            </tr>
                                                        </form>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div style="height: 400px" id="map"></div>
                            </div>
                        </div>
                        <!-- Container-fluid Ends-->
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnbqsA2WDTdc9LWs7gbkwJTht8J9JWnCc&libraries=places"></script>--}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBljJfIv11Pp1eoNE-gLPaTtZ-_fi7xYvE&libraries=places"></script>
<script>
    $(document).ready(function() {
        $('#search_collector').select2({
            ajax: {
                url: '{{ route('search.collector') }}', // Route for search controller method
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            },
            placeholder: "Select an option"
        });

        $('#search_captain').select2({
            ajax: {
                url: '{{ route('search.captain') }}', // Route for search controller method
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data.results
                    };
                },
                cache: true
            },
            placeholder: "Select an option"
        });
    });

    // function incrementQuantity(itemId, qtyInStock) {
    //     const quantityInput = document.getElementById(`quantity-${itemId}`);
    //     const originalCartQty = parseInt(document.getElementById(`original-qty-${itemId}`).value);

    //     if (quantityInput) {

    //         const currentQty = parseInt(quantityInput.value);
    //         const remainingStock = (originalCartQty + qtyInStock) - currentQty;

    //         if (remainingStock > 0) {
    //             quantityInput.value = currentQty + 1;
    //         } else {
    //             alert('Quantity of Item Must not be greater than item In-Stock');
    //         }
    //     }
    // }

    // function decrementQuantity(itemId, originalQuantity) {
    //     const quantityInput = document.getElementById(`quantity-${itemId}`);
    //     if (quantityInput && parseInt(quantityInput.value) != 1 ) {
    //         quantityInput.value = parseInt(quantityInput.value) - 1;
    //     }
    // }


    function incrementQuantity(itemId, qtyInStock) {
        const quantityInput = document.getElementById(`quantity-${itemId}`);
        const originalCartQty = parseInt(document.getElementById(`original-qty-${itemId}`).value);

        if (quantityInput) {
            const currentQty = parseInt(quantityInput.value);
            const remainingStock = (originalCartQty + qtyInStock) - currentQty;

            if (remainingStock > 0) {
                quantityInput.value = currentQty + 1;
                handleQuantityChange(itemId);
            } else {
                alert('Quantity of Item must not be greater than item in stock');
            }
        }
    }

    function decrementQuantity(itemId, originalQuantity) {
        const quantityInput = document.getElementById(`quantity-${itemId}`);
        if (quantityInput && parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            handleQuantityChange(itemId);
        }
    }

    // Core logic to enable/disable other controls
    function handleQuantityChange(activeId) {
        const allInputs = document.querySelectorAll('input[id^="quantity-"]');

        allInputs.forEach(input => {
            const id = input.id.replace('quantity-', '');
            const currentVal = parseInt(input.value);
            const originalVal = parseInt(document.getElementById(`original-qty-${id}`).value);
            const group = input.closest('.input-group');

            // Skip if this is the active item
            if (parseInt(id) !== activeId) {
                const activeInput = document.getElementById(`quantity-${activeId}`);
                const activeOriginal = parseInt(document.getElementById(`original-qty-${activeId}`).value);
                const activeCurrent = parseInt(activeInput.value);

                if (activeCurrent !== activeOriginal) {
                    // Disable +/- buttons for others
                    if (group) {
                        const plus = group.querySelector('.bootstrap-touchspin-up');
                        const minus = group.querySelector('.bootstrap-touchspin-down');
                        if (plus) plus.disabled = true;
                        if (minus) minus.disabled = true;
                        group.style.pointerEvents = "none";
                        group.style.opacity = 0.6;
                    }
                } else {
                    // Enable +/- buttons for others
                    if (group) {
                        const plus = group.querySelector('.bootstrap-touchspin-up');
                        const minus = group.querySelector('.bootstrap-touchspin-down');
                        if (plus) plus.disabled = false;
                        if (minus) minus.disabled = false;
                        group.style.pointerEvents = "auto";
                        group.style.opacity = 1;
                    }
                }
            }
        });
    }


    ///////////////////


    function confirmUpdateStatus() {
        return confirm('Are you sure you want to update the order?');
    }

    function confirmOrderCanceled() {
        return confirm('Are you sure you want to canceled the order?');
    }

    function confirmUpdateQuantity() {
        return confirm('Are you sure you want to Update the order Items Qty?');
    }

    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: {{optional($order)->deliveryAddress->latitude }}, lng: {{ optional($order)->deliveryAddress->longitude }} },
            zoom: 17
        });

        // Create a marker
        const marker = new google.maps.Marker({
            position: { lat: {{optional($order)->deliveryAddress->latitude }}, lng: {{ optional($order)->deliveryAddress->longitude }} },
            map: map
        });

        // Create an info window
        const infoWindow = new google.maps.InfoWindow({
            content: 'Order #' + {{ $order->id }} + 'Delivery Location',
        });

        // Add a listener to the marker to show the info window on click
        marker.addListener("click", () => {
            infoWindow.open(map, marker);
        });
    }

    window.onload = initMap;
</script>

<script>
    function applyCoupon(orderId) {
        const couponCode = document.getElementById('coupon_code_input').value;
        const responseDiv = document.getElementById('coupon-response-' + orderId);

        if (!couponCode) {
            responseDiv.innerHTML = `<span class="text-danger">Please enter a coupon code.</span>`;
            return;
        }

        fetch("{{ route('apply.coupon') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                coupon_code: couponCode,
                order_id: orderId
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    responseDiv.innerHTML = `<span class="text-success">${data.message}</span>`;

                    const redirectUrl = `/apply-coupon-to-order/${data.data.id}/${orderId}`;
                    window.location.href = redirectUrl;

                } else {
                    responseDiv.innerHTML = `<span class="text-danger">${data.message}</span>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                responseDiv.innerHTML = `<span class="text-danger">Something went wrong!</span>`;
            });
    }

    // add new product to order
    $(document).ready(function() {
        $('#product_id').select2({
            placeholder: 'Search for Product',
            minimumInputLength: 2,
            ajax: {
                url: '/search-products',
                dataType: 'json',
                delay: 100,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (params) {
                    return {
                        query: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.products, function (product) {
                            return {
                                id: product.id,
                                text: product.name_en
                            };
                        })
                    };
                },
                cache: true
            }
        });

        // When a product is selected, make another AJAX call to get the product variants
        $('#product_id').on('select2:select', function (e) {
            var selectedProductId = e.params.data.id;
            $.ajax({
                url: '/get-product-variants',
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    product_id: selectedProductId
                },
                success: function (response) {
                    var $variantsSelect = $('#variant_id'); // Assume you have another select with id 'variant_id'
                    $variantsSelect.empty();  // Clear previous options

                    $.each(response.variants, function (index, variant) {
                        var name = variant.weight + ' ' + variant.unit.name + ' - Qty ' + variant.quantity;
                        var option = new Option(name, variant.id);

                        //$(option).data('purchase-price', variant.purchase_price);
                        $(option).data('sale-price', variant.sale_price);
                        $(option).data('quantity', variant.quantity);

                        // Append the option to the select element
                        $variantsSelect.append(option);
                    });

                    // $.each(response.variants, function (index, variant) {
                    //     var name = variant.weight + ' ' + variant.unit.name + ' - Qty ' + variant.quantity;
                    //     var option = new Option(name, variant.id);
                    //     // $(option).data('purchase-price', variant.purchase_price);
                    //     $(option).data('price', variant.sale_price);
                    //     $(option).data('quantity', variant.quantity);
                    //     // Append the option to the select element
                    //     $variantsSelect.append(option);
                    // });

                    // Trigger Select2 update
                    $variantsSelect.trigger('change');
                    $variantsSelect.focus();
                },
                error: function (error) {
                    console.error('Error fetching product variants:', error);
                }
            });
        });

        $('#variant_id').on('change', function() {
            var variant_id = $(this).val();
            console.log(variant_id);
            // Get the selected option
            var selectedOption = $(this).find('option:selected');

            // Retrieve the purchase and sale prices from the data attributes
            var price = selectedOption.data('price');
            var quantity = selectedOption.data('quantity');

            // Assign the prices to the respective fields
            // $('#purchase_price').val(purchasePrice);
            $('.price').val(price);


            $.ajax({
                url: '/get-product-details',
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    variant_id: variant_id
                },
                success: function (response) {
                    console.log(response);
                    // var $variantsSelect = $('#variant_id'); // Assume you have another select with id 'variant_id'
                    // $variantsSelect.empty();  // Clear previous options

                    var $variantsSelect = $('#product_details_id');
                    $variantsSelect.empty(); // Clear previous options

                    $.each(response.variants, function (index, variant) {
                        var name = variant.product_packing
                            ? variant.product_packing.packaging_level
                            : 'Unknown Packaging';

                        var option = new Option(name, variant.id);

                        $(option).data('price', variant.price);
                        $variantsSelect.append(option);
                        $('.price').val(variant.price);
                    });

                    // // Trigger Select2 update
                    // $variantsSelect.trigger('change');
                    // $variantsSelect.focus();
                },
                error: function (error) {
                    console.error('Error fetching product variants:', error);
                }
            });

            $('#quantity').val('');
            $('#quantity').focus();
        });



        $('.add-stock-to-list').click(function(event) {
            if(handleFormSubmitValudation()) {
                $('#frm-add-new-item').submit();
            }
        });
    });


    function handleFormSubmitValudation() {
        var validation = 1;

        var product_id = parseInt($('.product_id').find('option:selected').val());
        if(product_id === 0){
            const errorMessage = `Product Must Be Selected.`;
            showErrorMessage(errorMessage);
            return false;
        }

        var product_details_id = parseInt($('.product_details_id').find('option:selected').val());
        if(product_details_id === 0){
            const errorMessage = `Product Packing Must Be Selected.`;
            showErrorMessage(errorMessage);
            return false;
        }

        var qty = $('.quantity').val();
        if(isNaN(qty) || qty == 0 || qty == ''){
            const errorMessage = `Item Quantity Must be greater then 0.`;
            showErrorMessage(errorMessage);
            return false;
        }

        var selectedOption = $("#variant_id").find('option:selected');
        var quantity = selectedOption.data('quantity');

        if(qty > quantity){
            const errorMessage = `Product Must Less then original Qty.`;
            showErrorMessage(errorMessage);
            return false;
        }

        var product_id = parseInt($('.product_id').find('option:selected').val());
        if(product_id === 0){
            const errorMessage = `Product Must Be Selected.`;
            showErrorMessage(errorMessage);
            return false;
        }

        var price = $('.price').val();
        if(isNaN(price) || price == 0 || price == ''){
            const errorMessage = `Price Must be Greater then 0`;
            showErrorMessage(errorMessage);
            return false;
        }

        if(validation == 1) {
            return true;
        }
        else {
            const errorMessage = `Please Complete all the Records Stock and QTY/Price must be greater then 0 in the list to submit.`;
            showErrorMessage(errorMessage);
            return false;
        }
    }

    function showErrorMessage(message) {
        const errorMessageElement = $('.error-message'); // Select the element with class "error-message"

        errorMessageElement.text(message);
        errorMessageElement.show();
        // Hide the error message after 30 seconds
        setTimeout(() => {
            errorMessageElement.hide();
        }, 30000); // 30 seconds in milliseconds
    }

    function toggleAddProduct() {
        const element = document.querySelector('.add_new_product');
        if (element.style.display === 'none' || element.style.display === '') {
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    }
</script>

