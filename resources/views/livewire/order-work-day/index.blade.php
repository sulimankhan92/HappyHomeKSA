<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Order Working</h3>
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
                        <h3 class="text-start">Order Work Days</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchPaymentMethods($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>
                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name en</th>
                                <th scope="col">Name ar</th>
                                <th scope="col">Work Day On/Off</th>
                                <th scope="col">Time Slots</th>
                                <th scope="col">On/Off</th>
                                <th scope="col">Deliveries</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($orderWorkDays as $orderWorkDay)
                                <tr wire:key="{{ $orderWorkDay->id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $orderWorkDay->name_en }}</td>
                                    <td>{{ $orderWorkDay->name_ar }}</td>
                                    <td>{{ $orderWorkDay->getOrderWorkDaysOptions()[$orderWorkDay->is_work_day] }}</td>
                                    <td>
                                        <a href="{{ route('working_days_time_slots', $orderWorkDay->id) }}">{{ __('Time Slots') }}</a>
{{--                                        <a href="{{ route('working_days_time_slots', $orderWorkDay->id) }}">Time Slots</a>--}}
{{--                                        <a wire:navigate href="{{ route('order-work-days.edit', $orderWorkDay->id) }}">{{ __('Edit') }}</a>--}}
{{--                                        <button--}}
{{--                                            type="button"--}}
{{--                                            wire:click="delete({{ $orderWorkDay->id }})"--}}
{{--                                            wire:confirm="Are you sure you want to delete?"--}}
{{--                                        >--}}
{{--                                            {{ __('Delete') }}--}}
{{--                                        </button>--}}
                                    </td>
                                    <td>
                                        <form action="{{ route('delivery-days-status.toggle-status', $orderWorkDay->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm {{ $orderWorkDay->is_work_day ? 'btn-danger' : 'btn-success' }}">
                                                {{ $orderWorkDay->is_work_day ? 'Set to Off' : 'Set to On' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('deliveries-per-day', $orderWorkDay->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('POST')
                                            <input  type="number" name="deliveries_per_day" value="{{ $orderWorkDay->deliveries_per_day }}" style="text-align: center;">
                                            <button type="submit" class="btn btn-sm btn-success">Update
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr><td></td></tr>
                            </tfoot>
                        </table>
                        {!! $orderWorkDays->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
