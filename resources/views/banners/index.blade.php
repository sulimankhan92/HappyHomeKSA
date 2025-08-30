<x-app-layout>
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6 ps-0">
                        <h3>Banner</h3>
                    </div>
                    <div class="col-sm-6 pe-0  text-end">
                        <a class="btn btn-primary" href="{{ route('banners.create') }}" >Add new Banner</a>
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
                            <h3 class="text-start">Banner List</h3>
                            <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                            </div>
                        </div>

                        <div class="table-responsive theme-scrollbar signal-table">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Order No</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($banners as $banner)
                                    <tr>
                                        <td>0</td>
                                        <td>
                                            <img src="{{ optional($banner->image) ? asset('storage/app_banner/' . $banner->image) : asset('storage/products/default.png') }}" width="60">
                                        </td>
                                        <td>{{ $banner->status ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr><td colspan="11"></td></tr>
                                </tbody>
                            </table>
                            {!! $banners->links('vendor.pagination.custom') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
</x-app-layout>
