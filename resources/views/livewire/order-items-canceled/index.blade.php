
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Canceled Orders</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <div class="btn-group" role="group">
                        <button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" style="">
                            <!--<a class="dropdown-item"  href="#" onclick="showSelectedOrdersOnMap()">Show on Map</a>-->
                            <!--<a class="dropdown-item" href="#" onclick="exportSelectedOrders('excel')">Order SVC Export</a>-->
                            <!--<a class="dropdown-item" href="#" onclick="exportSelectedOrders('pdf')">Orders PDF Print</a>-->
                        </div>
                    </div>
                    <!--<div class="dropdown">-->
                    <!--    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                    <!--        Actions-->
                    <!--    </button>-->
                    <!--    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">-->
                    <!--        <a class="dropdown-item" href="#" onclick="showSelectedOrdersOnMap()">Show on Map</a>-->
                    <!--        <a class="dropdown-item" href="#" onclick="printSelectedOrders()">Print PDF</a>-->
                    <!--        <a class="dropdown-item" href="#" onclick="submitSelectedOrdersForm()">Submit Form</a>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<a type="button" class="btn btn-primary" >Add new</a>-->
                    <!--<button type="button" onclick="showSelectedOrdersOnMap()" class="btn btn-primary">Show on Map</button>-->
                    <!--{{--                    <a type="button" class="btn btn-primary" wire:navigate href="{{ route('orders.create') }}">Add new</a>--}}-->
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
                        <h3 class="text-start">Canceled Orders List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="text" wire:keyup="searchOrders($event.target.value)" placeholder="Search..." style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                        {{--                        <h3>Hoverable Rows With Horizontal Border</h3><span>Hoverable row use a class  <code>table-hover</code> and for Horizontal border use a class <code>.table-border-horizontal</code> , Solid border Use a class<code>.border-solid .table</code>class.</span>--}}
                    </div>

                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
									<th>Order Id</th>
									<th>Customer</th>
									<th>Cancellation Reason</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($orderItemsCanceleds as $orderItemsCanceled)
                                    <tr class="even:bg-gray-50" wire:key="{{ $orderItemsCanceled->id }}">
										<td>{{ $orderItemsCanceled->id }}</td>
										<td>{{  optional($orderItemsCanceled)->customer->name ?? 'Null' }} - {{  optional($orderItemsCanceled)->customer->phone_number ?? 'Null' }}</td>
										<td>{{ $orderItemsCanceled->cancellation_reason }}</td>
                                    </tr>
                                @endforeach
                               </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    <div id="mapModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="map" style="height: 500px; width: 100%;"></div>
        </div>
    </div>
</div>