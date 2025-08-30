<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Product Purchases Returns</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" href="{{ route('purchases-returns.create') }}">Add new Returns</a>
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
                        <h3 class="text-start">Purchases Return</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchPurchasesReturn($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>
                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <tbody>
                            <thead>
                            <tr>
                                <th>Invoice#</th>
                                <th>Supplier</th>
                                <th>Total Tax</th>
                                <th>Shipping Cost</th>
                                <th>Discount</th>
                                <th>Paid Amount</th>
                                <th>Total Amount</th>
                                <th>Notes</th>
                                <th>Invoice Date</th>
                                <th>Created By</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($purchasesReturns as $purchasesReturn)
                                <tr class="even:bg-gray-50" wire:key="{{ $purchasesReturn->id }}">
                                    <td>{{ $purchasesReturn->invoice_no }}</td>
                                    <td>{{ $purchasesReturn->supplier->name }}</td>
                                    <td>{{ $purchasesReturn->total_tax }}</td>
                                    <td>{{ $purchasesReturn->shipping_cost }}</td>
                                    <td>{{ $purchasesReturn->total_discount }}</td>
                                    <td>{{ $purchasesReturn->paid_amount }}</td>
                                    <td>{{ $purchasesReturn->total_amount }}</td>
                                    <td>{{ $purchasesReturn->notes }}</td>
                                    <!--<td>{{ $purchasesReturn->status }}</td>-->
                                    <td>{{ $purchasesReturn->invoice_date }}</td>
                                    <td>{{ $purchasesReturn->createdbyUser->name }}</td>
                                    {{--                                     <td> --}}
                                    {{--                                            <a wire:navigate href="{{ route('purchases-returns.show', $purchasesReturn->id) }}">{{ __('Show') }}</a>--}}
                                    <!--<a href="{{ route('purchases-returns.edit', $purchasesReturn->id) }}">{{ __('Edit') }}</a>-->
                                    {{--                                            <a wire:navigate href="{{ route('purchases-returns.edit', $purchasesReturn->id) }}">{{ __('Edit') }}</a>--}}
                                    {{--                                            <button--}}
                                    {{--                                                type="button"--}}
                                    {{--                                                wire:click="delete({{ $purchasesReturn->id }})"--}}
                                    {{--                                                wire:confirm="Are you sure you want to delete?"--}}
                                    {{--                                            >--}}
                                    {{--                                                {{ __('Delete') }}--}}
                                    {{--                                            </button>--}}
                                    {{--              </td> --}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $purchasesReturns->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
