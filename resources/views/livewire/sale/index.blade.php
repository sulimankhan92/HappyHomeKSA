<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Product sales</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" wire:navigate href="{{ route('sales.create') }}">Add new</a>
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
                        <h3 class="text-start">sales List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchSales($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>

                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Created</th>
                                <th scope="col">Order Id</th>
                                <th scope="col">Sale Date</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Profit</th>
                                <th scope="col">Notes</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($sales as $sale)
                                <tr wire:key="{{ $sale->id }}">
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $sale->customer->name }}</td>
                                    <td>{{ $sale->user->name }}</td>
                                    <td>{{ $sale->order_id }}</td>
                                    <td>{{ $sale->sale_date }}</td>
                                    <td>{{ $sale->total_amount }}</td>
                                    <td>{{ $sale->total_profit }}</td>
                                    <td>{{ $sale->notes }}</td>
                                    <td>{{ $sale->status }}</td>

                                    <td>
                                        <a wire:navigate href="{{ route('sales.show', $sale->id) }}">{{ __('Show') }}</a>
                                        <a wire:navigate href="{{ route('sales.edit', $sale->id) }}">{{ __('Edit') }}</a>
                                        <button
                                            type="button"
                                            wire:click="delete({{ $sale->id }})"
                                            wire:confirm="Are you sure you want to delete?"
                                        >
                                            {{ __('Delete') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $sales->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
