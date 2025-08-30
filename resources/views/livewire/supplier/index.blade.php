<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Suppliers</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" wire:navigate href="{{ route('suppliers.create') }}" >Add new</a>
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
                        <h3 class="text-start">Suppliers List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchSupplier($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>

                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Vat Number</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Image</th>
                                <th scope="col">Country</th>
                                <th scope="col">Address</th>
                                <th scope="col">Location Link</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($suppliers as $supplier)
                                <tr wire:key="{{ $supplier->id }}" wire:loading.class="opacity-25">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->company_name }}</td>
                                    <td>{{ $supplier->vat_number }}</td>
                                    <td>{{ $supplier->phone_number }}</td>
                                    <td>{{ $supplier->image }}</td>
                                    <td>{{ $supplier->country }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td>{{ $supplier->location_link }}</td>
                                    <td>
                                        <p class="text-{{ $supplier->status ? 'success' : 'danger' }}">
                                            {{ $supplier->getStatusOptions()[$supplier->status] }}
                                        </p>
                                    </td>
                                    <td>
                                        <ul class="action">
                                            <li class="edit"> <a wire:navigate href="{{ route('suppliers.show', $supplier->id) }}"><i class="fa fa-eye"></i></a></li>
                                            <li class="edit"><a wire:navigate href="{{ route('suppliers.edit', $supplier->id) }}"><i class="fas fa-pencil-alt"></i></a></li>
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
                        {!! $suppliers->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
