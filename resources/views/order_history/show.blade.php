<x-app-layout>
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6 ps-0">
                        <h3>Order History</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid basic_table">
            <div class="row">
                <div class="col-sm-12">

                    <div class="card">
                        <x-alert />
                        <div class="card-header text-end">
                            <h3 class="text-start">Order History List</h3>
                            {{--                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchProduct($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>--}}
                            {{--                        </div>--}}
                        </div>

                        <div class="table-responsive theme-scrollbar signal-table">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Action Taken By</th>
                                    <th>Status</th>
                                    <th>Date Time</th>
                                    <th>Comments</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orderHistory as $history)
                                    <tr>
                                        <td>{{ optional($history->user)->name }}</td>
                                        <td>
                                            @php
                                                $nextStatus = $history->status;
                                                $buttonClass = '';

                                                switch ($nextStatus) {
                                                  case 1:
                                                        $buttonClass = 'btn-success';
                                                        break;
                                                    case 2:
                                                        $buttonClass = 'btn-info';
                                                        break;
                                                    case 3:
                                                        $buttonClass = 'btn-warning';
                                                        break;
                                                    case 7:
                                                        $buttonClass = 'btn-danger';
                                                        break;
                                                    case 8:
                                                        $buttonClass = 'btn-danger';
                                                        break;
                                                    default:
                                                        $buttonClass = 'btn-dark';
                                                }
                                            @endphp

                                            <button
                                                type="submit"
                                                class="btn {{ $buttonClass }} btn-xs"
                                            >
                                                @if($history->status=='1')
                                                    Order Place By {{ optional($history->user)->name }}
                                                @else
                                                    {{ $history->order->getStatusOptions()[$history->status] }}
                                                @endif
                                            </button>
                                        </td>
                                        <td>{{ $history->created_at }}</td>
                                        <td>{{ $history->comments }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
</x-app-layout>
