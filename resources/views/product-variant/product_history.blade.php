<x-app-layout>
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6 ps-0">
                        <h3>Product History</h3>
                    </div>
                    <div class="col-sm-6 pe-0  text-end">
                        {{--                    <a class="btn btn-primary" href="{{ route('products.create') }}" >Add new</a>--}}
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
                            <h3 class="text-start">products history</h3>
                            <div id="basic-1_filter" class="dataTables_filter">
                                <label>Search:
                                    <input type="search"  placeholder=""  aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;">
                                </label>
                            </div>
                        </div>

                        <div class="table-responsive theme-scrollbar signal-table">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Variant</th>
                                    <th>Action</th>
                                    <th>Details</th>
                                    <th>User</th>
                                    <th>Quantity</th>
                                    <th>Previous Qty</th>
                                    <th>Current Qty</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($histories as $history)
                                    <tr>
                                        <td>{{ $history->id }}</td>
                                        <td>{{ $history->productVariant->weight .' '. $history->productVariant->unit->name ?? 'N/A' }}</td>
                                        <td>{{ $history->action }}</td>
                                        <td>{{ $history->details }}</td>
                                        <td>{{ $history->user->name }}</td>
                                        <td>{{ $history->quantity }}</td>
                                        <td>{{ $history->previous_quantity }}</td>
                                        <td>{{ $history->current_quantity }}</td>
                                        <td>{{ $history->quantity_change }}</td>
                                        <td>{{ $history->status }}</td>
                                        <td>{{ $history->created_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--                        {!! $products->links('vendor.pagination.custom') !!}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
</x-app-layout>
