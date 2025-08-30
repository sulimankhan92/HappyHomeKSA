<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Product Variants</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Apps</li>
                        <li class="breadcrumb-item active">Product Variants & Packings </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="email-wrap bookmark-wrap">
            <div class="row">
                <div class="col-xl-3 box-col-3">
                    <div class="md-sidebar"><a class="btn btn-primary md-sidebar-toggle" href="javascript:void(0)">bookmark filter</a>
                        <div class="md-sidebar-aside job-left-aside custom-scrollbar">
                            <div class="email-left-aside">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="email-app-sidebar left-bookmark">
{{--                                            <div class="d-flex">--}}
{{--                                                <div class="media-size-email"><img class="me-3 rounded-circle" src="../assets/images/user/user.png" alt=""></div>--}}
{{--                                                <div class="flex-grow-1">--}}
{{--                                                    <h3 class="f-w-600">Create New Variants</h3>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <ul class="nav main-menu" role="tablist">
                                                <li class="nav-item">
                                                    <button class="badge-light-primary btn-block btn-mail txt-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#productVariantsModal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark me-2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg> New Variant</button>
                                                </li>
                                                <li class="nav-item"><span class="main-title"> Variants</span></li>
                                                @foreach ($productVariants as $productVariant)
                                                    <li>
{{--                                                        <a wire:click="editProductVariant({{ $productVariant->id }})" id="pills-created-tab"  aria-controls="pills-created" aria-selected="false" class="badge-light-primary btn-block btn-mail txt-primary w-100" tabindex="-1">--}}
                                                        <a class="show" id="pills-favourites-tab" data-bs-toggle="pill" href="#{{ $productVariant->id }}" role="tab" aria-controls="pills-favourites" aria-selected="false" tabindex="-1">
                                                            <span class="title">
                                                                {{ $productVariant->weight }} {{ $productVariant->unit->name }} - {{ $productVariant->getStatusOptions()[$productVariant->status] }}
{{--                                                                <a href="" onclick="editBookmark(0)" data-bs-toggle="modal" data-bs-target="#edit-bookmark"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon></svg></a>--}}
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endforeach
{{--                                                <li><a class="show" id="pills-favourites-tab" data-bs-toggle="pill" href="#pills-favourites" role="tab" aria-controls="pills-favourites" aria-selected="false" tabindex="-1"><span class="title"> Favourites</span></a></li>--}}
{{--                                                <li><a class="show" id="pills-shared-tab" data-bs-toggle="pill" href="#pills-shared" role="tab" aria-controls="pills-shared" aria-selected="false" tabindex="-1"><span class="title"> Shared with me</span></a></li>--}}
{{--                                                <li><a class="show active" id="pills-bookmark-tab" data-bs-toggle="pill" href="#pills-bookmark" role="tab" aria-controls="pills-bookmark" aria-selected="true"><span class="title"> My bookmark</span></a></li>--}}
{{--                                                <li><span class="main-title"> Tags<span class="pull-right"><a href="#" data-bs-toggle="modal" data-bs-target="#createtag"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></a></span></span></li>--}}
{{--                                                <li><a class="show" id="pills-notification-tab" data-bs-toggle="pill" href="#pills-notification" role="tab" aria-controls="pills-notification" aria-selected="false" tabindex="-1"><span class="title"> notification</span></a></li>--}}
{{--                                                <li><a class="show" id="pills-newsletter-tab" data-bs-toggle="pill" href="#pills-newsletter" role="tab" aria-controls="pills-newsletter" aria-selected="false" tabindex="-1"><span class="title"> Newsletter</span></a></li>--}}
{{--                                                <li><a class="show" id="pills-business-tab" data-bs-toggle="pill" href="#pills-business" role="tab" aria-controls="pills-business-tab" aria-selected="false" tabindex="-1"><span class="title"> Business</span></a></li>--}}
{{--                                                <li><a class="show" id="pills-holidays-tab" data-bs-toggle="pill" href="#pills-holidays" role="tab" aria-controls="pills-holidays-tab" aria-selected="false" tabindex="-1"><span class="title"> Holidays</span></a></li>--}}
{{--                                                <li><a class="show" id="pills-important-tab" data-bs-toggle="pill" href="#pills-important" role="tab" aria-controls="pills-important-tab" aria-selected="false" tabindex="-1"><span class="title"> Important</span></a></li>--}}
{{--                                                <li><a class="show" id="pills-orgenization-tab" data-bs-toggle="pill" href="#pills-orgenization" role="tab" aria-controls="pills-orgenization-tab" aria-selected="false" tabindex="-1"><span class="title"> Orgenization</span></a></li>--}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-md-12 box-col-80">
                    <div class="email-right-aside bookmark-tabcontent">
                        <div class="card email-body radius-left">
                            <div class="ps-0">
                                <div class="tab-content">
                                    @foreach ($productVariants as $productVariant)
                                    <div class="fade tab-pane" id="{{ $productVariant->id }}" role="tabpanel" aria-labelledby="pills-bookmark-tab">
                                        <div class="card mb-0">
                                            <div class="card-header d-flex pb-0">
                                                <h3 class="mb-0">{{ $product->name_en .' | '. $product->name_ar }}</h3>
                                                <ul>
                                                    <li><a class="grid-bookmark-view" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg></a></li>
                                                    <li><a class="list-layout-view" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg></a></li>
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="details-bookmark text-center list-bookmark" style="opacity: 1;">
                                                    <div class="card card-with-border bookmark-card o-hidden">
                                                        <div class="row" id="bookmarkData">
{{--                                                            @if($product->productDetails)--}}
{{--                                                                @foreach($product->productDetails as $details)--}}
                                                                   <div class="col-xxl-3 col-md-4 col-ed-4">
                                                                       <div class="card card-with-border bookmark-card o-hidden">
                                                                            <div class="details-website"><img class="img-fluid" src="{{ optional($product->productImages->first())->file_name ? asset('storage/products/' . optional($product->productImages->first())->file_name) : asset('storage/products/default.png') }}" alt="">
                                                                                <div class="favourite-icon favourite_0" onclick="setFavourite(0)"><a href="#"><i class="fa fa-star"></i></a></div>
                                                                                <div class="desciption-data">
                                                                                    <div class="title-bookmark">
                                                                                        <h3 class="title_0">{{ $productVariant->weight }} {{ $productVariant->unit->name }} - {{ $productVariant->getStatusOptions()[$productVariant->status] }}</h3>
{{--                                                                                        <p class="weburl_0">{{ $details->price }}</p>--}}
                                                                                        <div class="hover-block">
                                                                                            <ul>
                                                                                                <li><a wire:click="editProductVariant({{ $productVariant->id }})" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon></svg></a></li>
                                                                                                <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg></a></li>
                                                                                                <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg></a></li>
                                                                                                <li><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></li>
                                                                                                <li class="pull-right text-end"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg></a></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                        <div class="content-general">
                                                                                            <span class="collection_0">{{ $productVariant->getStatusOptions()[$productVariant->status] }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                       </div>
                                                                   </div>
{{--                                                                @endforeach--}}
{{--                                                            @endif--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    <div wire:ignore.self wire:submit.prevent="createProductVariant"  class="modal fade modal-bookmark" id="productVariantsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLabel">Add Bookmark</h3>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-bookmark needs-validation" id="bookmark-form" novalidate="">
                                                        <input type="hidden" wire:model="product_id">
                                                        <div class="row g-2">
                                                            <div class="mb-3 mt-0 col-md-3">
                                                                <label for="bm-weburl">Weight</label>
                                                                <div class="input-group">
                                                                    <input class="form-control" wire:model="weight" type="number" placeholder="Enter weight" required="" autocomplete="off">
                                                                    <select id="unit_id" wire:model="unit_id" class="dropdown-toggle" type="button" data-bs-toggle="dropdown" >
                                                                        <ul class="" style="">
                                                                            <option value=""></option>
                                                                            @foreach(App\Models\Unit::all() as $key => $value)
                                                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                                            @endforeach
                                                                        </ul>
                                                                    </select>
                                                                </div>
                                                                @error('weight')
                                                                    <x-input-error class="mt-2" :messages="$message"/>
                                                                @enderror
                                                                @error('unit_id')
                                                                    <x-input-error class="mt-2" :messages="$message"/>
                                                                @enderror
                                                            </div>
{{--                                                            <div class="mb-3 mt-0 col-md-4">--}}
{{--                                                                <label for="bm-weburl">Weight</label>--}}
{{--                                                                <input class="form-control" wire:model="weight" type="number" placeholder="Enter weight" required="" autocomplete="off">--}}
{{--                                                                @error('weight')--}}
{{--                                                                    <x-input-error class="mt-2" :messages="$message"/>--}}
{{--                                                                @enderror--}}
{{--                                                            </div>--}}
{{--                                                            <div class="mb-3 mt-0 col-md-4">--}}
{{--                                                                <label>Unit</label>--}}
{{--                                                                <select wire:model="unit_id" id="unit_id" name="status" class="form-control" autocomplete="unit_id">--}}
{{--                                                                    <option value="" >Select Unit</option>--}}
{{--                                                                    @foreach(App\Models\Unit::all() as $key => $value)--}}
{{--                                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>--}}
{{--                                                                    @endforeach--}}
{{--                                                                    @error('unit_id')--}}
{{--                                                                        <x-input-error class="mt-2" :messages="$message"/>--}}
{{--                                                                    @enderror--}}
{{--                                                                </select>--}}
{{--                                                                @error('unit_id')--}}
{{--                                                                    <x-input-error class="mt-2" :messages="$message"/>--}}
{{--                                                                @enderror--}}
{{--                                                            </div>--}}
                                                            <div class="mb-3 mt-0 col-md-3">
                                                                <label for="bm-title">Quantity Alerts</label>
                                                                <input class="form-control" wire:model="quantity_alerts" type="number" placeholder="Enter quantity alerts" required="" autocomplete="off">
                                                                @error('quantity_alerts')
                                                                    <x-input-error class="mt-2" :messages="$message"/>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-3 mt-0 col-md-3">
                                                                <label for="bm-title">Expiry Date Alerts</label>
                                                                <input class="form-control" wire:model="expiry_date_alerts" type="number" placeholder="Enter expiry date alerts" required="" autocomplete="off">
                                                                @error('expiry_date_alerts')
                                                                    <x-input-error class="mt-2" :messages="$message"/>
                                                                @enderror
                                                            </div>
{{--                                                            <div class="mb-3 mt-0 col-md-4">--}}
{{--                                                                <label for="bm-title">expiry date remove</label>--}}
{{--                                                                <input class="form-control" wire:model="expiry_date" type="date" placeholder="Enter expiry date" autocomplete="off">--}}
{{--                                                                @error('expiry_date')--}}
{{--                                                                    <x-input-error class="mt-2" :messages="$message"/>--}}
{{--                                                                @enderror--}}
{{--                                                            </div>--}}
                                                            <div class="mb-3 mt-0 col-md-3">
                                                                <label for="bm-title">Status</label>
                                                                <select wire:model="status" id="status" name="status" class="form-control" autocomplete="status">
                                                                    <option value="" >Select Status</option>
                                                                    @foreach(App\Models\ProductVariant::getStatusOptions() as $key => $value)
                                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('status')
                                                                    <x-input-error class="mt-2" :messages="$message"/>
                                                                @enderror
                                                            </div>
{{--                                                            <div class="mb-3 mt-0 col-md-6">--}}
{{--                                                                <label>Group</label>--}}
{{--                                                                <select class="js-example-basic-single select2-hidden-accessible" id="bm-group" tabindex="-1" aria-hidden="true">--}}
{{--                                                                    <option value="bookmark">My Bookmarks</option>--}}
{{--                                                                </select>--}}
{{--                                                                <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: auto;">--}}
{{--                                                                    <span class="selection">--}}
{{--                                                                        <span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-bm-group-container">--}}
{{--                                                                            <span class="select2-selection__rendered" id="select2-bm-group-container" title="My Bookmarks">My Bookmarks</span>--}}
{{--                                                                            <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>--}}
{{--                                                                        </span>--}}
{{--                                                                    </span>--}}
{{--                                                                    <span class="dropdown-wrapper" aria-hidden="true">--}}
{{--                                                                    </span>--}}
{{--                                                                </span>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="mb-3 mt-0 col-md-6">--}}
{{--                                                                <label>Collection</label>--}}
{{--                                                                <select class="js-example-disabled-results select2-hidden-accessible" id="bm-collection" tabindex="-1" aria-hidden="true">--}}
{{--                                                                    <option value="general">General</option>--}}
{{--                                                                    <option value="fs">fs</option>--}}
{{--                                                                </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: auto;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-bm-collection-container"><span class="select2-selection__rendered" id="select2-bm-collection-container" title="fs">fs</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>--}}
{{--                                                            </div>--}}
                                                        </div>
                                                        <button class="btn btn-primary" id="Bookmark" type="submit">Save</button>
                                                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
