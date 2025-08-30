<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Wallet</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" href="{{ route('wallets.create') }}">Add new Points</a>
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
                        <h3 class="text-start">Wallet Points List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchWallet($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>
                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">User</th>
                                <th scope="col">Name</th>
                                <th scope="col">Balance</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($wallets as $wallet)
                                <tr wire:key="{{ $wallet->id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $wallet->user->name }}</td>
                                    <td>{{ $wallet->name }}</td>
                                    <td>{{ $wallet->balance }}</td>
                                    <td>
                                        <p class="text-{{ $wallet->status ? 'success' : 'danger' }}">
                                            {{ $wallet->getStatusOptions()[$wallet->status] }}
                                        </p>
                                    </td>
                                    <td>
{{--                                        <a wire:navigate href="{{ route('wallets.show', $wallet->id) }}">{{ __('Show') }}</a>--}}
                                        <a href="{{ route('wallets.edit', $wallet->id) }}">{{ __('Edit') }}</a>
{{--                                        <button--}}
{{--                                            type="button"--}}
{{--                                            wire:click="delete({{ $wallet->id }})"--}}
{{--                                            wire:confirm="Are you sure you want to delete?"--}}
{{--                                        >--}}
{{--                                            {{ __('Delete') }}--}}
{{--                                        </button>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $wallets->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
