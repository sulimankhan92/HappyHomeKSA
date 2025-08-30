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
                        <h3>Orders Tax Summary</h3>@if (!empty($from))<p>Summary from {{ $from }} to {{ $to }}</p>@endif
                    </div>
                    <div class="col-sm-6 pe-0  text-end">
                        {{--                        <div class="btn-group" role="group">--}}
                        {{--                            <button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>--}}
                        {{--                            <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" style="">--}}
                        {{--                                <a class="dropdown-item"  href="#" onclick="showSelectedOrdersOnMap()">Show on Map</a>--}}
                        {{--                                <a class="dropdown-item" href="#" onclick="exportSelectedOrders('excel')">Order SVC Export</a>--}}
                        {{--                                <a class="dropdown-item" href="#" onclick="exportSelectedOrders('pdf')">Orders PDF Print</a>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
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
                            <h3 class="text-start">Tax Summary</h3>
                            <div id="basic-1_filter" class="dataTables_filter">
                                <form method="GET" action="{{ route('orders.tax_summary') }}">
                                    <label>
                                        Order Status*:
                                        <select name="status" style="border: 1px solid #efefef; padding: 0 10px; margin-left: 10px; height: 37px; border-radius: 0;">
                                            <option value="">-- Select an option --</option>
                                            @foreach ($statusOptions as $key => $label)
                                                <option value="{{ $key }}" {{ $status == $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>

                                    </label>

                                    <label>
                                        From:
                                        <input type="date" name="from_date" value="{{ request('from_date') }}"
                                               style="border: 1px solid #efefef; padding: 0 10px; margin-left: 10px; height: 37px; border-radius: 0;">
                                    </label>

                                    <label>
                                        To:
                                        <input type="date" name="to_date" value="{{ request('to_date') }}"
                                               style="border: 1px solid #efefef; padding: 0 10px; margin-left: 10px; height: 37px; border-radius: 0;">
                                    </label>

                                    <input type="submit" value="Search"
                                           style="border: 1px solid #efefef; padding: 0 10px; margin-left: 10px; height: 37px; border-radius: 0;">
                                </form>

                            </div>
                        </div>

                        <div class="table-responsive theme-scrollbar signal-table">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Total Orders</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Total Tax</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (!empty($summary))
                                    <tr>
                                        <td>{{ $summary['order_count'] }}</td>
                                        <td>{{ number_format($summary['total_amount'], 2) }}</td>
                                        <td>Total Tax: {{ number_format($summary['total_tax'], 2) }}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</x-app-layout>
