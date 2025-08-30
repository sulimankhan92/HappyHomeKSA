<x-app-layout>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Time Slot</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary"  href="{{ route('delivery-times.create', $deliveryTimeSlots->order_work_day_id) }}">Add new</a>
                    <a class="btn btn-primary"  href="{{ route('order-work-days.index') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid basic_table">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">
{{--                    <x-alert />--}}
{{--                    <div class="card-header text-end">--}}
{{--                        <h3 class="text-start">products List</h3>--}}
{{--                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchProduct($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Time Slot</th>
                                <th scope="col">Status</th>
                                <th scope="col">On/Off</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($deliveryTimeSlots as $deliveryTime)
                                <tr>
                                    <td>{{ $deliveryTime->time_slot }}</td>
                                    <td>{{ $deliveryTime->getOrderWorkDaysOptions()[$deliveryTime->status]  }}</td>
                                    <td>
                                        <form action="{{ route('delivery-times.toggle-status', $deliveryTime->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm {{ $deliveryTime->status ? 'btn-danger' : 'btn-success' }}">
                                                {{ $deliveryTime->status ? 'Set to Off' : 'Set to On' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('delivery-times.edit', ['deliveryTime' => $deliveryTime->id, 'workingDayId' => $deliveryTimeSlots->order_work_day_id]) }}">
                                            {{ __('Edit') }}
                                        </a>
                                    </td>
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
