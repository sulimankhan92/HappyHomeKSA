<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Delivery Packages</h3>
                </div>
                {{--                <div class="col-sm-6 pe-0  text-end">--}}
                {{--                    <a class="btn btn-primary" wire:navigate href="{{ route('delivery-packages.create') }}">Add new</a>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid basic_table">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header text-end">
                        <h3 class="text-start">Delivery Packages List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchDeliveryPackages($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>
                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name Ar</th>
                                <th scope="col">Name En</th>
                                <th scope="col">Price</th>
                                <th scope="col">Order Delivery Price</th>
                                <th scope="col">Time Slot</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($deliveryPackages as $deliveryPackage)
                                <tr wire:key="{{ $deliveryPackage->id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $deliveryPackage->name_ar }}</td>
                                    <td>{{ $deliveryPackage->name_en }}</td>
                                    <td>{{ $deliveryPackage->price }}</td>
                                    <td>{{ $deliveryPackage->urgent_price }}</td>
                                    <td>{{ $deliveryPackage->time_slot }}</td>
                                    <td>{{ $deliveryPackage->getdeliveryPackageOptions()[$deliveryPackage->status] }}</td>
                                    <td>
                                        {{--                                        <a wire:navigate href="{{ route('delivery-packages.show', $deliveryPackage->id) }}">{{ __('Show') }}</a>--}}
                                        <a wire:navigate href="{{ route('delivery-packages.edit', $deliveryPackage->id) }}">{{ __('Edit') }}</a>
                                        {{--                                        <button--}}
                                        {{--                                            type="button"--}}
                                        {{--                                            wire:click="delete({{ $deliveryPackage->id }})"--}}
                                        {{--                                            wire:confirm="Are you sure you want to delete?"--}}
                                        {{--                                        >--}}
                                        {{--                                            {{ __('Delete') }}--}}
                                        {{--                                        </button>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $deliveryPackages->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
