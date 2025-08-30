<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Product purchases</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" href="{{ route('purchases.create') }}">Add new</a>
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
                        <h3 class="text-start">purchases List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchPurchases($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>

                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                {{--                                <th scope="col">No</th>--}}
                                <th scope="col">Invoice #</th>
                                <th scope="col">Invoice Date</th>

                                {{--                                <th scope="col">Total Tax</th>--}}
                                {{--                                <th scope="col">Shipping Cost</th>--}}
                                {{--                                <th scope="col">Total Discount</th>--}}
                                <th scope="col">Total Amount</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Supplier</th>
                                {{--                                <th scope="col">Paid Amount</th>--}}
                                <th scope="col">Notes</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($purchases as $purchase)
                                <tr wire:key="{{ $purchase->id }}">
                                    {{--                                    <td>{{ ++$i }}</td>--}}
                                    <td>{{ $purchase->invoice_no }}</td>
                                    <td>{{ $purchase->invoice_date }}</td>
                                    {{--                                    <td>{{ $purchase->total_tax }}</td>--}}
                                    {{--                                    <td>{{ $purchase->shipping_cost }}</td>--}}
                                    {{--                                    <td>{{ $purchase->total_discount }}</td>--}}
                                    <td>{{ $purchase->total_amount }}</td>
                                    <td>{{ $purchase->user->name }}</td>
                                    <td>{{ $purchase->supplier->name }}</td>
                                    <td>{{ $purchase->notes }}</td>
                                    <td>{{ $purchase->created_at }}</td>
                                    {{--                                    <td>{{ $purchase->status }}</td>--}}
                                    <td>
                                        {{--                                        <a wire:navigate href="{{ route('purchases.show', $purchase->id) }}">{{ __('Show') }}</a>--}}
                                        <a href="{{ route('purchases.edit', $purchase->id) }}">{{ __('Edit') }}</a>
                                        {{--                                        <button--}}
                                        {{--                                            type="button"--}}
                                        {{--                                            wire:click="delete({{ $purchase->id }})"--}}
                                        {{--                                            wire:confirm="Are you sure you want to delete?"--}}
                                        {{--                                        >--}}
                                        {{--                                            {{ __('Delete') }}--}}
                                        {{--                                        </button>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $purchases->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
