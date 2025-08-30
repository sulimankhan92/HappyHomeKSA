<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Coupons Usage</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" wire:navigate href="{{ route('coupon-users.create') }}">Add new</a>
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
                        <h3 class="text-start">Coupons List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchCouponUsers($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>

                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Coupon</th>
                                <th scope="col">User</th>
                                <th scope="col">Order Id</th>
                                <th scope="col">Used Count</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($couponUsers as $couponUser)
                                <tr wire:key="{{ $couponUser->id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $couponUser->coupon->title_en }}</td>
                                    <td>{{ $couponUser->user->name }}</td>
                                    <td>{{ $couponUser->order_id }}</td>
                                    <td>{{ $couponUser->used_count }}</td>
                                    <td>
                                        <a wire:navigate href="{{ route('coupon-users.show', $couponUser->id) }}">{{ __('Show') }}</a>
                                        <a wire:navigate href="{{ route('coupon-users.edit', $couponUser->id) }}">{{ __('Edit') }}</a>
                                        <button
                                            type="button"
                                            wire:click="delete({{ $couponUser->id }})"
                                            wire:confirm="Are you sure you want to delete?"
                                        >
                                            {{ __('Delete') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                        {!! $couponUsers->withQueryString('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
