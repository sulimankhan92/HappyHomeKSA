<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Product Promotion</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" wire:navigate href="{{ route('product-promotions.create') }}" >Add new</a>
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
                        <h3 class="text-start">Promotion List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchProductPromotion($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>

                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">No</th>

                                <th scope="col">Product Details Id</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Promotion Price</th>
                                <th scope="col">Starting Date</th>
                                <th scope="col">Last Date</th>
                                <th scope="col">Status</th>

                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($productPromotions as $productPromotion)
                                <tr class="even:bg-gray-50" wire:key="{{ $productPromotion->id }}">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $productPromotion->product_details_id }}</td>
                                    <td>{{ $productPromotion->created_by }}</td>
                                    <td>{{ $productPromotion->promotion_price }}</td>
                                    <td>{{ $productPromotion->starting_date }}</td>
                                    <td>{{ $productPromotion->last_date }}</td>
                                    <td>{{ $productPromotion->status }}</td>
                                    <td>
                                        <a wire:navigate href="{{ route('product-promotions.show', $productPromotion->id) }}">{{ __('Show') }}</a>
                                        <a wire:navigate href="{{ route('product-promotions.edit', $productPromotion->id) }}">{{ __('Edit') }}</a>
                                        <button
                                            type="button"
                                            wire:click="delete({{ $productPromotion->id }})"
                                            wire:confirm="Are you sure you want to delete?"
                                        >
                                            {{ __('Delete') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $productPromotions->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
