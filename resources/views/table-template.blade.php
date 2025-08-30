<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>New Orders</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a type="button" class="btn btn-primary" >Add new</a>
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
                        <h3 class="text-start">New Orders List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>

                    <div class="table-responsive theme-scrollbar signal-table">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Status</th>
                                <th scope="col">Signal Name	</th>
                                <th scope="col">Security</th>
                                <th scope="col">Stage</th>
                                <th scope="col">Schedule</th>
                                <th scope="col">Team Lead</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td class="d-flex align-items-center"><i class="bg-light-success font-success" data-feather="alert-triangle"></i><span class="font-success">No Signal</span></td>
                                <td>Astrid: NE Shared managed</td>
                                <td>Medium</td>
                                <td>Triaged</td>
                                <td>0.33	</td>
                                <td>Chase Nguyen	</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
