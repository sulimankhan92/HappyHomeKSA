<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>New Coupons</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary"  wire:navigate href="{{ route('coupons.create') }}" >Add new</a>
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
                                <th scope="col">Creator</th>
                                <th scope="col">Code</th>
                                <th scope="col">Title</th>
{{--                                <th scope="col">Title</th>--}}
{{--                                <th scope="col">Description</th>--}}
{{--                                <th scope="col">Description</th>--}}
{{--                                <th scope="col">Use Counts</th>--}}
                                <th scope="col">Category</th>
                                <th scope="col">Type</th>
{{--                                <th scope="col">All Users</th>--}}
                                <th scope="col">Amount</th>
                                <th scope="col">Percentage</th>
                                <th scope="col">Active</th>
                                <th scope="col">Starts</th>
                                <th scope="col">Ends</th>
                                <th scope="col">Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($coupons as $coupon)
                                <tr wire:key="{{ $coupon->id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ optional($coupon)->user->name }}</td>
                                    <td>{{ $coupon->code }}</td>
                                    <td>{{ $coupon->title_en }}</td>
{{--                                    <td>{{ $coupon->title_ar }}</td>--}}
{{--                                    <td>{{ $coupon->description_en }}</td>--}}
{{--                                    <td>{{ $coupon->description_ar }}</td>--}}
{{--                                    <td>{{ $coupon->coupon_use_counts }}</td>--}}
                                    <td>{{ $coupon->getCouponCategory()[$coupon->coupon_category] }}</td>
                                    <td>{{ $coupon->getCouponType()[$coupon->type] }}</td>
{{--                                    <td>{{ $coupon->getCouponUsageUsersOptions()[$coupon->is_for_all_users] }}</td>--}}
{{--                                    <td>{{ $coupon->minimum_order_amount }}</td>--}}
                                    <td>{{ $coupon->amount }}</td>
                                    <td>{{ $coupon->percentage }}</td>
                                    <td>{{ $coupon->getIsActiveOptions()[$coupon->is_active] }}</td>
                                    <td>{{ $coupon->start_date }}</td>
                                    <td>{{ $coupon->end_date }}</td>
                                    <td>
{{--                                        <a wire:navigate href="{{ route('coupons.show', $coupon->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">{{ __('Show') }}</a>--}}
                                        <a href="{{ route('coupons.edit', $coupon->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900  mr-2">{{ __('Edit') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $coupons->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
