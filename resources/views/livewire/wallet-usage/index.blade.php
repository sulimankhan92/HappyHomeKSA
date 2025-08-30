<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Wallet Usage</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" wire:navigate  href="{{ route('wallet-usages.create') }}">Add new</a>
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
                        <h3 class="text-start">Wallet Used List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchWalletUsage($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>
                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Wallet Id</th>
                                <th scope="col">Wallet Transaction Id</th>
                                <th scope="col">User Id</th>
                                <th scope="col">Order Id</th>
                                <th scope="col">Amount Used</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($walletUsages as $walletUsage)
                                <tr wire:key="{{ $walletUsage->id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $walletUsage->wallet_id }}</td>
                                    <td>{{ $walletUsage->wallet_transaction_id }}</td>
                                    <td>{{ $walletUsage->user_id }}</td>
                                    <td>{{ $walletUsage->order_id }}</td>
                                    <td>{{ $walletUsage->amount_used }}</td>
                                    <td>
                                        <a wire:navigate href="{{ route('wallet-usages.show', $walletUsage->id) }}">{{ __('Show') }}</a>
                                        <a wire:navigate href="{{ route('wallet-usages.edit', $walletUsage->id) }}">{{ __('Edit') }}</a>
                                        <button
                                            type="button"
                                            wire:click="delete({{ $walletUsage->id }})"
                                            wire:confirm="Are you sure you want to delete?"
                                        >
                                            {{ __('Delete') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $walletUsages->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
