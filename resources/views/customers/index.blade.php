<x-app-layout>
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6 ps-0">
                        <h3>Customers</h3>
                    </div>
                    <div class="col-sm-6 pe-0  text-end">
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
                            <h3 class="text-start">Customers List</h3>
                            <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                            </div>
                        </div>

                        <div class="table-responsive theme-scrollbar signal-table">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Wallet Points</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Location Link</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->phone_number }}</td>
                                        <td>{{ $customer->wallet_balance }}</td>
                                        <td>{{ $customer->country }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->location_link }}</td>

                                        <td><img width="80px"
                                                 src="{{ optional($customer->profile_image) ? asset('storage/profile_image/' . $customer->profile_image) : asset('storage/products/default.png') }}"
                                                 alt="Profile Image">
                                        </td>
                                        <td>
                                            <p class="text-{{ $customer->status ? 'success' : 'danger' }}">
                                                {{-- {{ $customer->getStatusOptions()[$customer->status] }} --}}
                                            </p>
                                        </td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit"> <a href="{{ route('customers.show', $customer->id) }}"><i class="fa fa-eye"></i></a></li>
                                                <li class="edit"><a href="{{ route('customers.edit', $customer->id) }}"><i class="fas fa-pencil-alt"></i></a></li>
                                            </ul>
                                            {{--                                        <button--}}
                                            {{--                                            type="button"--}}
                                            {{--                                            wire:click="delete({{ $supplier->id }})"--}}
                                            {{--                                            wire:confirm="Are you sure you want to delete?"--}}
                                            {{--                                        >--}}
                                            {{--                                            {{ __('Delete') }}--}}
                                            {{--                                        </button>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                <tr><td colspan="11"></td></tr>
                                </tbody>
                            </table>
                            {!! $customers->links('vendor.pagination.custom') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
</x-app-layout>
