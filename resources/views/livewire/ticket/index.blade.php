<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>New Tickets</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" wire:navigate href="{{ route('tickets.create') }}">Add new</a>
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
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchTickets($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>
                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">User Id</th>
                                <th scope="col">Ticket Process By</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tickets as $ticket)
                                <tr wire:key="{{ $ticket->id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $ticket->user_id }}</td>
                                    <td>{{ $ticket->ticket_process_by }}</td>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>{{ $ticket->status }}</td>
                                    <td>
                                        <a wire:navigate href="{{ route('tickets.show', $ticket->id) }}">{{ __('Show') }}</a>
                                        <a wire:navigate href="{{ route('tickets.edit', $ticket->id) }}">{{ __('Edit') }}</a>
                                        <button
                                            type="button"
                                            wire:click="delete({{ $ticket->id }})"
                                            wire:confirm="Are you sure you want to delete?"
                                        >
                                            {{ __('Delete') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $tickets->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
