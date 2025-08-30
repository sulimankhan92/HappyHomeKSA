<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Order Tickets</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" wire:navigate href="{{ route('order-tickets.create') }}">Add new</a>
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
                        <h3 class="text-start">Tickets List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchOrderTickets($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>
                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">User</th>
                                <th scope="col">Order Id</th>
                                <th scope="col">Process By User</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orderTickets as $orderTicket)
                                <tr class="even:bg-gray-50" wire:key="{{ $orderTicket->id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $orderTicket->user_id }}</td>
                                    <td>{{ $orderTicket->order_id }}</td>
                                    <td>{{ $orderTicket->ticket_process_by_user }}</td>
                                    <td>{{ $orderTicket->subject }}</td>
                                    <td>{{ $orderTicket->status }}</td>
                                    <td>
                                        <a wire:navigate href="{{ route('order-tickets.show', $orderTicket->id) }}">{{ __('Show') }}</a>
                                        <a wire:navigate href="{{ route('order-tickets.edit', $orderTicket->id) }}">{{ __('Edit') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $orderTickets->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
