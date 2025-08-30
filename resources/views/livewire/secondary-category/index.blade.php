<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Secondary Category</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary"  wire:navigate href="{{ route('secondary-categories.create') }}" >Add new</a>
                    {{--                    <a type="button" class="btn btn-primary" wire:navigate href="{{ route('orders.create') }}">Add new</a>--}}
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
                        <h3 class="text-start">Secondary Category List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchSecondaryCategory($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>

                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Category</th>
                                <th scope="col">Name En</th>
                                <th scope="col">Name Ar</th>
                                <th scope="col">Detail En</th>
                                <th scope="col">Detail Ar</th>
                                <th scope="col">Order</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($secondaryCategories as $secondaryCategory)
                                <tr wire:key="{{ $secondaryCategory->id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $secondaryCategory->category->name_en }}</td>
                                    <td>{{ $secondaryCategory->name_en }}</td>
                                    <td>{{ $secondaryCategory->name_ar }}</td>
                                    <td>{{ $secondaryCategory->detail_en }}</td>
                                    <td>{{ $secondaryCategory->detail_ar }}</td>
                                    <td>{{ $secondaryCategory->order }}</td>
                                    <td>
                                        <p class="text-{{ $secondaryCategory->status ? 'success' : 'danger' }}">
                                            {{ $secondaryCategory->getStatusOptions()[$secondaryCategory->status] }}
                                        </p>
                                    </td>
                                    <td>
                                        <a wire:navigate href="{{ route('secondary-categories.show', $secondaryCategory->id) }}"><i class="fa fa-eye"></i></a>
                                        <a wire:navigate href="{{ route('secondary-categories.edit', $secondaryCategory->id) }}"><i class="fas fa-pencil-alt"></i></a>
                                        {{--                                        <button--}}
                                        {{--                                            type="button"--}}
                                        {{--                                            wire:click="delete({{ $secondaryCategory->id }})"--}}
                                        {{--                                            wire:confirm="Are you sure you want to delete?"--}}
                                        {{--                                        >--}}
                                        {{--                                            {{ __('Delete') }}--}}
                                        {{--                                        </button>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $secondaryCategories->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
