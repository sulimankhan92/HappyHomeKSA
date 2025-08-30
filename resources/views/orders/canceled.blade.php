<x-app-layout>
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6 ps-0">
                        <h3>Cancellation Requests</h3>
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
                            <h3 class="text-start">Order Cancellation Request</h3>
                            <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="text" wire:keyup="searchOrders($event.target.value)" placeholder="Search..." style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                            </div>
                            {{--                        <h3>Hoverable Rows With Horizontal Border</h3><span>Hoverable row use a class  <code>table-hover</code> and for Horizontal border use a class <code>.table-border-horizontal</code> , Solid border Use a class<code>.border-solid .table</code>class.</span>--}}
                        </div>

                        <div class="table-responsive theme-scrollbar signal-table">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" sortable >No</th>
                                    <th scope="col">Customer</th>
                                    {{--                                <th scope="col">User Order Managed By</th>--}}
                                    {{--                                <th scope="col">User Order Collected By</th>--}}
                                    {{--                                <th scope="col">User Order Delivered By</th>--}}
                                    {{--                                <th scope="col">Payment Method Id</th>--}}
                                    {{--                                <th scope="col">Note</th>--}}
                                    <!--<th scope="col">Product Total</th>-->
                                    <!--<th scope="col">Total Tax</th>-->
                                    <!--<th scope="col">Delivery Cost</th>-->
                                    <!--<th scope="col">Total Discount</th>-->
                                    <th scope="col">Cancellation Reason</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Total Amount Paid</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $order)
                                    <tr wire:key="{{ $order->id }}" wire:loading.class="opacity-25">
                                        <td>{{ $order->id }}</td>
                                        <td>{{  optional($order)->customer->name ?? 'Null' }} - {{  optional($order)->customer->phone_number ?? 'Null' }}</td>
                                        {{--                                    <td>{{  optional($order)->orderManager->name ?? 'Null' }}</td>--}}
                                        {{--                                    <td>{{  optional($order)->orderCollector->name ?? 'Null' }}</td>--}}
                                        {{--                                    <td>{{  optional($order)->deliveryCaptain->name ?? 'Null' }}</td>--}}
                                        {{--                                    <td>{{ $order->payment_method_id }}</td>--}}
                                        {{--                                    <td>{{ $order->notes }}</td>--}}
                                        <!--<td>{{ $order->product_total }}</td>-->
                                        <!--<td>{{ $order->total_tax }}</td>-->
                                        <!--<td>{{ $order->delivery_cost }}</td>-->
                                        <!--<td>{{ $order->total_discount }}</td>-->
                                        <td>{{ $order->cancellation_reason }}</td>
                                        <td>{{ $order->total_amount }}</td>
                                        <td>{{ $order->total_amount_paid }}</td>
                                        {{--                                    <td>{{ $order->notes }}</td>--}}
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success dropdown-toggle btn-md" id="btnGroupVerticalDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" style="">
                                                    <li><a class="dropdown-item" href="{{ route('orders.update_status', [$order->id, 0]) }}">Canceled</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('orders.update_status', [$order->id, 1]) }}">Accepted</a></li>
                                                </div>
                                            </div>
                                            <!--<div class="dropdown">-->
                                            <!--    <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">-->
                                            <!--        Accept/Reject-->
                                            <!--    </button>-->
                                            <!--    <ul class="dropdown-menu" aria-labelledby="orderStatusDropdown{{ $order->id }}">-->
                                            <!--        <li><a class="dropdown-item" href="{{ route('orders.update_status', [$order->id, 0]) }}">Canceled</a></li>-->
                                            <!--        <li><a class="dropdown-item" href="{{ route('orders.update_status', [$order->id, 1]) }}">Accepted</a></li>-->
                                            <!--    </ul>-->
                                            <!--</div>-->
                                            <!--<a class="btn btn-{{ $order->status == 1 ? 'primary' : ($order->status == 2 ? 'info' : ($order->status == 3 ? 'warning' : 'danger')) }} btn-xs">-->
                                            <!--    {{ $order->getStatusOptions()[$order->status] }}-->
                                            <!--</a>-->
                                        </td>
                                        <td>
                                            <a href="{{ route('orders.order_items', $order->id) }}">view</a>
                                            {{--                                        <a wire:navigate href="{{ route('orders.orderItems', $order->id) }}">view</a>--}}
                                            {{--                                        <a wire:navigate href="{{ route('orders.show', $order->id) }}">Show</a>--}}
                                            {{--                                        <a wire:navigate href="{{ route('orders.edit', $order->id) }}">{{ __('Edit') }}</a>--}}
                                        </td>
                                        <td>
                                            <a href="{{ route('order_pdf_invoice', $order->id) }}" class="btn btn-primary btn-xs">
                                                Invoice
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--                        {!! $orders->withQueryString()->links() !!}--}}
                            {{--                        <div>--}}
                            {!! $orders->links('vendor.pagination.custom') !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
</x-app-layout>
