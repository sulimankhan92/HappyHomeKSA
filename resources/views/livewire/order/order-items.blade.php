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
                <div class="card">
                    {{--                    <div class="card-header">--}}
                    {{--                        <h3>Items</h3>--}}
                    {{--                    </div>--}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 xl-100 col-sm-12 mb-2">
                                <div class="d-flex"><img class="me-3 rounded-circle" src="{{ asset('assets/images/user/user.png')  }}" alt="">
                                    <div class="flex-grow-1">
                                        <h3 class="p-0">{{ $order->customer->name  }}  <small><span>(20</span> January) <span>6:00</span> AM</small></h3>
                                        <p>{{ $order->customer->address .' '.$order->customer->city  }} </p>
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
                                                        <th scope="col">Paid</th>
                                                        <th scope="col">Total</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Created</th>
                                                        <th scope="col">Time Ago</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td><span class="badge {{ $class['paymentBadgeClass'] }}">{{ optional($order)->paymentMethod->name_en ?? 'Null' }}</span></td>
                                                        <td>{{ $order->total_tax }}</td>
                                                        <td>{{ $order->total_discount }}</td>
                                                        <td>{{ $order->delivery_cost }}</td>
                                                        <td>{{ $order->total_amount }}</td>
                                                        <td>{{ $order->total_amount_paid }}</td>
                                                        <td>
                                                            <a class="btn btn-primary btn-xs">
                                                                {{ $order->getStatusOptions()[$order->status] }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @php
                                                                use Carbon\Carbon;
                                                                $formattedDate = Carbon::parse($order->created_at)->format('(d F) g:i A');
                                                                $timeAgo = Carbon::parse($order->created_at)->diffForHumans();
                                                            @endphp
                                                            {{ $formattedDate }}
                                                        </td>
                                                        <td>{{$timeAgo}}</td>
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
                                        <th>Weight</th>
                                        <th>Packaging</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>status</th>
                                        <th>Checked</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                <img class="img-fluid img-80"
                                                     src="{{ optional( $item->productDetail->productVariant->product->productImages->first())->file_name ? asset('storage/products/' . optional( $item->productDetail->productVariant->product->productImages->first())->file_name) : asset('storage/products/default.png') }}"
                                                     alt="#">
                                            </td>
                                            <td>
                                                <div class="product-name">
                                                    <a href="#">
                                                        {{ $item->productDetail->productVariant->product->name_en  }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td>{{ $item->productDetail->productVariant->weight  }}</td>
                                            <td>{{ $item->productDetail->productPacking->packaging_level  }}</td>
                                            <td>{{ $item->quantity  }}</td>
                                            <td>{{ $item->productDetail->price  }}</td>
                                            <td><a class="btn btn-primary btn-xs">{{ $item->getStatusOptions()[$item->status] }}</a></td>
                                            <td>
                                                <i class="font-danger" data-feather="x-circle"></i>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle font-success">
                                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                </svg>
                                            </td>
                                            <td>SAR {{ $item->quantity*$item->productDetail->price  }}</td>
                                        </tr>
                                    @endforeach

                                    <tr>
                                        <td class="text-end" colspan="8"><a class="btn btn-secondary cart-btn-transform" href="">Continue Shopping</a></td>
                                        <td>
                                            <a class="btn btn-success cart-btn-transform">
                                                Accept
                                            </a>
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
                                                    <tr>
                                                        <td>{{  optional($order)->orderManager->name ?? '' }}</td>
                                                        <td>{{  optional($order)->orderCollector->name ?? '' }}</td>
                                                        <td>{{  optional($order)->deliveryCaptain->name ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <div>
                                                                <select class="form-select input-air-primary digits" id="user-select" wire:model="selectedUser">
                                                                    <option value="">Select a user</option>
                                                                </select>
                                                            </div>
                                                            {{--                                                            <select class="form-select input-air-primary digits" id="exampleFormControlSelect17">--}}
                                                            {{--                                                                <option>--}}
                                                            {{--                                                                    <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Search..." style="border: 1px solid #efefef; padding: 0 10px; margin-left: 10px; height: 37px; border-radius: 0;">--}}
                                                            {{--                                                                </option>--}}
                                                            {{--                                                                @foreach($users as $user)--}}
                                                            {{--                                                                    <option>{{ $user->name }}</option>--}}
                                                            {{--                                                                @endforeach--}}
                                                            {{--                                                            </select>--}}

                                                            {{--                                                            <select class="form-select input-air-primary digits" id="exampleFormControlSelect17">--}}
                                                            {{--                                                                <option><input type="text" wire:keyup="addCollector($event.target.value)" placeholder="Search..." style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></option>--}}
                                                            {{--                                                                @foreach($users as $user)--}}
                                                            {{--                                                                    <option>{{ $user->name }} </option>--}}
                                                            {{--                                                                @endforeach--}}
                                                            {{--                                                            </select>--}}

                                                        </td>
                                                        <td>{{  optional($order)->deliveryCaptain->name ?? 'Null' }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Container-fluid Ends-->
                </div>
            </div>
        </div>
    </div>
</div>
