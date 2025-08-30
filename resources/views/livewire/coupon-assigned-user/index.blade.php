<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>New Coupons</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" href="{{ route('coupon-assigned-users.create') }}" >Add new</a>
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
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchCoupon($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>

                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Coupon</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Assigned By User</th>
{{--                                <th scope="col">Used Count</th>--}}
                                <th scope="col">Is Active</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($couponAssignedUsers as $couponAssignedUser)
                                <tr wire:key="{{ $couponAssignedUser->id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $couponAssignedUser->coupon->title_en }}</td>
                                    <td>{{ $couponAssignedUser->user->name }}</td>
                                    <td>{{ $couponAssignedUser->created_by->name }}</td>
{{--                                    <td>{{ $couponAssignedUser->used_count }}</td>--}}
                                    <td>{{ $couponAssignedUser->getIsActiveOptions()[$couponAssignedUser->is_active] }}</td>
                                    <td>
{{--                                        <a wire:navigate href="{{ route('coupon-assigned-users.show', $couponAssignedUser->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">{{ __('Show') }}</a>--}}
                                        <a href="{{ route('coupon-assigned-users.edit', $couponAssignedUser->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900  mr-2">{{ __('Edit') }}</a>
{{--                                        <button--}}
{{--                                            type="button"--}}
{{--                                            wire:click="delete({{ $couponAssignedUser->id }})"--}}
{{--                                            wire:confirm="Are you sure you want to delete?"--}}
{{--                                        >--}}
{{--                                            {{ __('Delete') }}--}}
{{--                                        </button>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $couponAssignedUsers->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
