<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Product Purchases Returns</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" href="{{ route('purchase-returns.create') }}">Add new Returns</a>
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
                            <thead>
                                <tr>
                                    <th scope="col">Invoice #</th>
                                    <th scope="col">Invoice Date</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Notes</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($purchaseReturns as $purchaseReturn)
                                <tr wire:key="{{ $purchaseReturn->id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $purchaseReturn->invoice_no }}</td>
                                    <td>{{ $purchaseReturn->purchase_id }}</td>
                                    <td>{{ $purchaseReturn->return_date }}</td>
                                    <td>{{ $purchaseReturn->reason }}</td>
                                    <td>{{ $purchaseReturn->total_refunded }}</td>
                                    <td>
                                        <a wire:navigate href="{{ route('purchase-returns.show', $purchaseReturn->id) }}">{{ __('Show') }}</a>
                                        <a wire:navigate href="{{ route('purchase-returns.edit', $purchaseReturn->id) }}">{{ __('Edit') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $purchaseReturns->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
