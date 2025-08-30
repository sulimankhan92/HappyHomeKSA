<x-app-layout>
    <div class="page-body">
        <style>
            /* Modal styles */
            .modal {
                display: none;
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0, 0, 0);
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal-content {
                background-color: #fefefe;
                margin: 4% auto;
                padding: 10px;
                border: 1px solid #888;
                width: 91%;
                position: relative;
            }

            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }

        </style>
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6 ps-0">
                        <h3>Orders Verifications</h3>
                    </div>
                    <div class="col-sm-6 pe-0  text-end">
                        <div class="btn-group" role="group">
                            <button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" style="">
                                <!--<a class="dropdown-item"  href="#" onclick="showSelectedOrdersOnMap()">Show on Map</a>-->
                                <a class="dropdown-item" href="#" onclick="exportSelectedOrders('excel')">Order SVC Export</a>
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
                            <h3 class="text-start">Unverified Orders List</h3>
                            <div id="basic-1_filter" class="dataTables_filter">
                                <form method="GET" action="{{ route('orders.verification') }}" id="rider-filter-form">
                                    <label>
                                        Rider:
                                        <select name="rider_id" style="border: 1px solid #efefef; padding: 0 10px; margin-left: 10px; height: 37px; border-radius: 0;">
                                            <option value="">-- Select an option --</option>
                                            @foreach($captains as $captain)
                                                <option value="{{ $captain->id }}" {{ request('rider_id') == $captain->id ? 'selected' : '' }}>
                                                    {{ $captain->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </label>

                                    <label>
                                        From:
                                        <input type="date" name="from" value="{{ request('from') }}" style="border: 1px solid #efefef; padding: 0 10px; margin-left: 10px; height: 37px; border-radius: 0;">
                                    </label>

                                    <label>
                                        To:
                                        <input type="date" name="to" value="{{ request('to') }}" style="border: 1px solid #efefef; padding: 0 10px; margin-left: 10px; height: 37px; border-radius: 0;">
                                    </label>

                                    <input type="submit" value="Search" style="border: 1px solid #efefef; padding: 0 10px; margin-left: 10px; height: 37px; border-radius: 0; display: inline-flex; align-items: center; gap: 5px;">
                                    <lable>
                                        <a href="{{ route('orders.verification') }}"
                                           style="border: 1px solid #efefef; padding: 0 10px; margin-left: 10px; height: 37px; border-radius: 0; display: inline-flex; align-items: center; gap: 5px;color: #c65e2d;">
                                            <i class="fas fa-times-circle" style="font-size: 14px;"></i>
                                        </a>
                                    </lable>

                                </form>



                                <!--<label>-->
                                <!--    Rider:-->
                                <!--    <select style="border: 1px solid #efefef; padding: 0 10px; margin-left: 10px; height: 37px; border-radius: 0;">-->
                                <!--        <option value="">-- Select an option --</option>-->
                                <!--        @foreach($captains as $captain)-->
                                <!--            <option value="{{ $captain->id }}">{{ $captain->name }}</option>-->
                                <!--        @endforeach-->
                                <!--    </select>-->
                                <!--</label>-->
                                <!--<label>-->
                                <!--    From:-->
                                <!--<input type="date" placeholder="Search..." style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;">-->
                                <!--</label>-->
                                <!--<label>-->
                                <!--    To:-->
                                <!--<input type="date" placeholder="Search..." style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;">-->
                                <!--</label>-->
                                <!--<input type="submit" value="Search" placeholder="Search..." style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;">-->
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
                                    <th scope="col">Location</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Delivery Day</th>
                                    <th scope="col">Total Amount</th>
                                    <!--<th scope="col">Invoice</th>-->
                                    <th scope="col">Rider/ Driver </th>
                                    <th scope="col">History</th>
                                    <th scope="col">Verified</th>
                                    <th scope="col">
                                        Verified
                                    </th>
                                    <th scope="col">
                                        <input type="checkbox" id="select-all">
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('order_pdf_invoice', $order->id) }}" >
                                                Invoice #{{ $order->id }}
                                            </a>
                                        </td>
                                        <td>{{  optional($order)->customer->name ?? 'Null' }} - {{  optional($order)->customer->phone_number ?? 'Null' }}</td>
                                        {{-- <td>{{  optional($order)->orderManager->name ?? 'Null' }}</td>--}}
                                        {{-- <td>{{  optional($order)->orderCollector->name ?? 'Null' }}</td>--}}
                                        {{-- <td>{{ $order->payment_method_id }}</td>--}}
                                        {{-- <td>{{ $order->notes }}</td>--}}
                                        <td>
                                            <img
                                                src="{{ asset('assets/images/logo/map.png') }}"
                                                data-latitude="{{ optional($order->deliveryAddress)->latitude ?? '' }}"
                                                data-longitude="{{ optional($order->deliveryAddress)->longitude ?? '' }}"
                                                class="map-marker-icon"
                                                style="cursor: pointer;"
                                                alt="Map Marker"
                                            />
                                            <!--<i -->
                                            <!--    data-latitude="{{ optional($order->deliveryAddress)->latitude ?? '' }}" -->
                                            <!--    data-longitude="{{ optional($order->deliveryAddress)->longitude ?? '' }}" -->
                                            <!--    class="fa fa-map-marker map-marker-icon" -->
                                            <!--    style="cursor: pointer;">-->
                                            <!--</i>-->
                                        </td>
                                        <td>
                                            <!--<a class="btn btn-{{ $order->status == 1 ? 'primary' : ($order->status == 2 ? 'info' : ($order->status == 3 ? 'warning' : 'dark')) }} btn-xs">-->
                                            <!--    {{ $order->getStatusOptions()[$order->status] }}-->
                                            <!--</a>-->
                                            <!--<form method="POST" action="{{ route('order.update_order_status') }}" style="display: inline;">-->
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <input type="hidden" name="status" value="{{ $order->status }}">
                                            <input type="hidden" name="new_status" value="{{ $order->getNextStatus($order->status) }}">

                                            @php
                                                $nextStatus = $order->status;
                                                $buttonClass = '';

                                                switch ($nextStatus) {
                                                  case 1:
                                                        $buttonClass = 'btn-success';
                                                        break;
                                                    case 2:
                                                        $buttonClass = 'btn-info';
                                                        break;
                                                    case 3:
                                                        $buttonClass = 'btn-warning';
                                                        break;
                                                    case 7:
                                                        $buttonClass = 'btn-danger';
                                                        break;
                                                    case 8:
                                                        $buttonClass = 'btn-danger';
                                                        break;
                                                    default:
                                                        $buttonClass = 'btn-dark';
                                                }
                                            @endphp

                                            <button
                                                type="button"
                                                class="btn {{ $buttonClass }} btn-xs"
                                                onclick="return confirmUpdateStatus()"
                                            >
                                                {{ $order ? $order->getStatusOptions()[$nextStatus] : 'No Next Status' }}
                                            </button>
                                            <!--</form>-->
                                        </td>
                                        <td>{{ optional($order)->deliveryDay->name_en ?? '' }} - {{ optional($order)->deliveryTime->time_slot ?? '' }}</td>
                                        <td>{{ $order->total_amount }}</td>
                                        <td>{{  optional($order)->deliveryCaptain->name ?? 'Pending..' }}</td>
                                        <!--<td>{{ $order->total_amount_paid }}</td>-->
                                        {{--                                    <td>{{ $order->notes }}</td>--}}
                                        <td style="text-align:center">
                                            <a href="{{ route('order.history.show', ['orderId' => $order->id]) }}"><i style="font-size:20px;" class="fa fa-history text-info" aria-hidden="true"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('orders.order_items', $order->id) }}">view</a>
                                            {{--                                        <a wire:navigate href="{{ route('orders.orderItems', $order->id) }}">view</a>--}}
                                            {{--                                        <a wire:navigate href="{{ route('orders.show', $order->id) }}">Show</a>--}}
                                            {{--                                        <a wire:navigate href="{{ route('orders.edit', $order->id) }}">{{ __('Edit') }}</a>--}}
                                        </td>
                                        <!--<td>-->
                                        <!--    <a href="{{ route('order_pdf_invoice', $order->id) }}" class="btn btn-primary btn-xs">-->
                                        <!--         Invoice-->
                                        <!--    </a>-->
                                        <!--</td>-->
                                        <td>
                                            @if (!$order->is_order_verified)
                                                <form method="POST" action="{{ route('orders.verify', $order->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-xs">Verify</button>
                                                </form>
                                            @else
                                                Verified
                                            @endif

                                            <!--<input type="checkbox" name="selected_items[]" value="{{ $order->id }}" class="item-checkbox">-->
                                        </td>
                                        <td>
                                            <!--<input type="checkbox" name="selected_items[]" value="{{ $order->id }}" class="item-checkbox"-->
                                            <!--      value="{{ $order->id }}"-->
                                            <!--       data-latitude="{{ optional($order)->deliveryAddress->latitude ?? '' }}"-->
                                            <!--    data-longitude="{{ optional($order)->deliveryAddress->longitude ?? '' }}">-->
                                            <input type="checkbox" name="selected_items[]" value="{{ $order->id }}" class="item-checkbox">
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--                        {!! $orders->withQueryString()->links() !!}--}}
                            {{--                        <div>--}}
                            {{--                            {!! $orders->links('vendor.pagination.custom') !!}--}}

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

    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnbqsA2WDTdc9LWs7gbkwJTht8J9JWnCc&libraries=places"></script>-->

    <!--show location of multiple order-->
    <script>
        // function showSelectedOrdersOnMap() {
        //     let checkboxes = document.querySelectorAll('.order-checkbox:checked');
        //     let coordinates = [];

        //     checkboxes.forEach(checkbox => {
        //         let latitude = checkbox.dataset.latitude;
        //         let longitude = checkbox.dataset.longitude;
        //         let orderId = checkbox.value;

        //         if (latitude && longitude) {
        //             coordinates.push({
        //                 lat: parseFloat(latitude),
        //                 lng: parseFloat(longitude),
        //                 orderId: orderId
        //             });
        //         }
        //     });

        //     if (coordinates.length > 0) {
        //         initMap(coordinates);
        //     } else {
        //         alert('No orders selected!');
        //     }

        //     document.getElementById('mapModal').style.display = 'block';
        // }

        // function closeMapModal() {
        //     document.getElementById('mapModal').style.display = 'none';
        // }

        // function initMap(coordinates) {
        //     let map = new google.maps.Map(document.getElementById('map'), {
        //         zoom: 10,
        //         center: coordinates[0]
        //     });

        //     coordinates.forEach(coord => {
        //         let marker = new google.maps.Marker({
        //             position: { lat: coord.lat, lng: coord.lng },
        //             map: map
        //         });

        //         let infoWindow = new google.maps.InfoWindow({
        //             content: `Order ID: ${coord.orderId}`
        //         });

        //         marker.addListener('click', function () {
        //             infoWindow.open(map, marker);
        //         });
        //     });
        // }

        function exportSelectedOrders(exportType) {
            let selectedOrders = getSelectedOrders();

            if (selectedOrders.length > 0) {
                // Create a hidden form to submit the selected order IDs
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('export.orders') }}"; // Replace with your actual route

                // Add CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);

                // Create hidden input fields for order IDs
                selectedOrders.forEach(orderId => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'order_ids[]'; // Use an array for multiple IDs
                    input.value = orderId;
                    form.appendChild(input);
                });

                // Add hidden field to differentiate between PDF and Excel
                const exportTypeInput = document.createElement('input');
                exportTypeInput.type = 'hidden';
                exportTypeInput.name = 'export_type';
                exportTypeInput.value = exportType; // "pdf" or "excel" based on the function call
                form.appendChild(exportTypeInput);

                // Submit the form
                document.body.appendChild(form);
                form.submit();
            } else {
                alert('No orders selected for export!');
            }
        }

        function getSelectedOrders() {
            let checkboxes = document.querySelectorAll('.item-checkbox:checked');
            return Array.from(checkboxes).map(checkbox => checkbox.value);
        }
    </script>


    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        <!--    document.addEventListener('DOMContentLoaded', function () {-->
        <!--        const modal = document.getElementById('mapModal');-->
        <!--        const mapElement = document.getElementById('map');-->
        <!--        let map, marker;-->

        // Initialize the map
        <!--        function initMap(lat, lng) {-->
        <!--            if (!map) {-->
        <!--                map = new google.maps.Map(mapElement, {-->
        <!--                    center: { lat: lat, lng: lng },-->
        <!--                    zoom: 15,-->
        <!--                });-->
        <!--                marker = new google.maps.Marker({-->
        <!--                    position: { lat: lat, lng: lng },-->
        <!--                    map: map,-->
        <!--                });-->
        <!--            } else {-->
        <!--                map.setCenter({ lat: lat, lng: lng });-->
        <!--                marker.setPosition({ lat: lat, lng: lng });-->
        <!--            }-->
        <!--        }-->

        // Show the modal with the map
        <!--        document.querySelectorAll('.map-marker-icon').forEach(function (icon) {-->
        <!--            icon.addEventListener('click', function () {-->
        <!--                const lat = parseFloat(this.getAttribute('data-latitude'));-->
        <!--                const lng = parseFloat(this.getAttribute('data-longitude'));-->

        <!--                initMap(lat, lng);-->
        <!--                modal.style.display = 'block';-->
        <!--            });-->
        <!--        });-->

        // Close the modal
        <!--        document.querySelector('.close').addEventListener('click', function () {-->
        <!--            modal.style.display = 'none';-->
        <!--        });-->

        <!--        window.onclick = function (event) {-->
        <!--            if (event.target == modal) {-->
        <!--                modal.style.display = 'none';-->
        <!--            }-->
        <!--        };-->
        <!--    });-->

        <!--    function confirmUpdateStatus() {-->
        <!--        return confirm('Are you sure you want to update the order status?');-->
        <!--    }-->

    </script>

</x-app-layout>
