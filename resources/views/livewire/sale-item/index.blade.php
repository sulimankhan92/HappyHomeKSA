<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Product sales</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
{{--                    <a class="btn btn-primary" wire:navigate href="{{ route('sale-items.create') }}">Add new</a>--}}
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
                        <h3 class="text-start">Products Sale List</h3>
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <div class="d-flex align-items-center gap-2">
                                    <label class="mb-0">From:</label>
                                    <input type="date" wire:model="fromDate" class="form-control">
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <label class="mb-0">To:</label>
                                    <input type="date" wire:model="toDate" class="form-control">
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <label class="mb-0">Search:</label>
                                    <input type="search" wire:model="search" class="form-control">
                                </div>

                            <div class="d-flex gap-2">
                                <button wire:click="applyFilters" class="btn btn-sm btn-outline-primary">
                                    Search
                                </button>
                                <button wire:click="resetFilters" class="btn btn-sm btn-outline-danger">
                                    Clear
                                </button>
                                <button wire:click="exportCSV" class="btn btn-sm btn-outline-success">
                                    Export CSV
                                </button>
                            </div>
                            </div>
                        </div>
                    </div>


                    {{--                    <div class="card-header text-end">--}}
{{--                        <h3 class="text-start">Products sale List</h3>--}}
{{--                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchSales($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Purchase Price</th>
                                    <th scope="col">Sale Price</th>
                                    <th scope="col">Profit Per Item</th>
                                    <th scope="col">Total Profit</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Expiry Date</th>
                                    <th scope="col">Created at</th>
{{--                                    <th scope="col"></th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($saleItems as $saleItem)
                                    <tr class="even:bg-gray-50" wire:key="{{ $saleItem->id }}">
                                        <td>{{ ++$i }}</td>

                                        <td>{{ $saleItem->user->name }}</td>
                                        <td>{{ $saleItem->order_id }}</td>
                                        <td>{{ $saleItem->productVariant->product->name_en }}</td> {{-- product --}}
                                        <td>{{ $saleItem->quantity }}</td>
                                        <td>{{ $saleItem->purchase_price }}</td>
                                        <td>{{ $saleItem->unit_price }}</td>
                                        <td>{{ $saleItem->profit_per_item }}</td>
                                        <td>{{ $saleItem->profit }}</td>
                                        <td><a class="btn {{ $saleItem->status == 2 ? 'btn-danger' : 'btn-primary'  }} btn-xs">{{ $saleItem->status == 2 ? 'Canceled' : 'Order'  }}</a></td>
                                        <td>{{ $saleItem->expiry_date }}</td>
                                        <td>{{ $saleItem->created_at }}</td>
{{--                                        <td>--}}
{{--                                            <a wire:navigate href="{{ route('sale-items.show', $saleItem->id) }}">{{ __('Show') }}</a>--}}
{{--                                            <a wire:navigate href="{{ route('sale-items.edit', $saleItem->id) }}">{{ __('Edit') }}</a>--}}
{{--                                            <button--}}
{{--                                                class="text-red-600 font-bold hover:text-red-900"--}}
{{--                                                type="button"--}}
{{--                                                wire:click="delete({{ $saleItem->id }})"--}}
{{--                                                wire:confirm="Are you sure you want to delete?"--}}
{{--                                            >--}}
{{--                                                {{ __('Delete') }}--}}
{{--                                            </button>--}}
{{--                                        </td>--}}
                                    </tr>
                                @endforeach
                        </table>
                        {!! $saleItems->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>


@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('filters-reset', () => {
                // You can add any custom JS logic here when filters are reset
            });
        });
    </script>
@endpush


{{--<div class="py-12">--}}
{{--    <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">--}}
{{--        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--            <div class="w-full">--}}
{{--                <div class="sm:flex sm:items-center">--}}
{{--                    <div class="sm:flex-auto">--}}
{{--                        <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Sale Items') }}</h1>--}}
{{--                        <p class="mt-2 text-sm text-gray-700">A list of all the {{ __('Sale Items') }}.</p>--}}
{{--                    </div>--}}
{{--                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">--}}
{{--                        <a type="button" wire:navigate href="{{ route('sale-items.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add new</a>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="flow-root">--}}
{{--                    <div class="mt-8 overflow-x-auto">--}}
{{--                        <div class="inline-block min-w-full py-2 align-middle">--}}
{{--                            <table class="w-full divide-y divide-gray-300">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>--}}

{{--									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Customer Id</th>--}}
{{--									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Sale Id</th>--}}
{{--									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Product Variant Id</th>--}}
{{--									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Quantity</th>--}}
{{--									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Unit Price</th>--}}
{{--									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Expiry Date</th>--}}

{{--                                    <th scope="col" class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"></th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody class="divide-y divide-gray-200 bg-white">--}}
{{--                                @foreach ($saleItems as $saleItem)--}}
{{--                                    <tr class="even:bg-gray-50" wire:key="{{ $saleItem->id }}">--}}
{{--                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-gray-900">{{ ++$i }}</td>--}}

{{--										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $saleItem->customer_id }}</td>--}}
{{--										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $saleItem->sale_id }}</td>--}}
{{--										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $saleItem->product_variant_id }}</td>--}}
{{--										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $saleItem->quantity }}</td>--}}
{{--										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $saleItem->unit_price }}</td>--}}
{{--										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $saleItem->expiry_date }}</td>--}}

{{--                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">--}}
{{--                                            <a wire:navigate href="{{ route('sale-items.show', $saleItem->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">{{ __('Show') }}</a>--}}
{{--                                            <a wire:navigate href="{{ route('sale-items.edit', $saleItem->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900  mr-2">{{ __('Edit') }}</a>--}}
{{--                                            <button--}}
{{--                                                class="text-red-600 font-bold hover:text-red-900"--}}
{{--                                                type="button"--}}
{{--                                                wire:click="delete({{ $saleItem->id }})"--}}
{{--                                                wire:confirm="Are you sure you want to delete?"--}}
{{--                                            >--}}
{{--                                                {{ __('Delete') }}--}}
{{--                                            </button>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}

{{--                            <div class="mt-4 px-4">--}}
{{--                                {!! $saleItems->withQueryString()->links() !!}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
