<div class="page-body">

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>{{ __('Product Variants') }}</h3>
                </div>
                <div class="col-sm-6 pe-0  text-end">
                    <a class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#productVariantsModal">Add Variant</a>
                    {{--                    <a class="btn btn-primary" wire:navigate href="{{ route('product-variants.create') }}">Add new</a>--}}
                </div>
            </div>
        </div>


    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div>
            <div class="row product-page-main p-0">
                <div class="col-xxl-4 col-md-6 box-col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="product-slider owl-carousel owl-theme owl-loaded owl-drag" id="sync1">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage" style="transform: translate3d(-1937px, 0px, 0px); transition: 0.25s; width: 6202px;">
                                        <div class="owl-item cloned" style="width: 387.587px;">
                                            <div class="item"><img src="{{ optional($product->productImages->first())->file_name ? asset('storage/products/' . optional($product->productImages->first())->file_name) : asset('storage/products/default.png') }}" alt=""></div>
                                        </div>
                                        <div class="owl-item " style="width: 387.587px;">
                                            <div class="item"><img src="{{ optional($product->productImages->first())->file_name ? asset('storage/products/' . optional($product->productImages->first())->file_name) : asset('storage/products/default.png') }}" alt=""></div>
                                        </div>
                                        <div class="owl-item " style="width: 387.587px;">
                                            <div class="item"><img src="{{ optional($product->productImages->first())->file_name ? asset('storage/products/' . optional($product->productImages->first())->file_name) : asset('storage/products/default.png') }}" alt=""></div>
                                        </div>
                                        <div class="owl-item " style="width: 387.587px;">
                                            <div class="item"><img ssrc="{{ optional($product->productImages->first())->file_name ? asset('storage/products/' . optional($product->productImages->first())->file_name) : asset('storage/products/default.png') }}" alt=""></div>
                                        </div>
                                        <div class="owl-item" style="width: 387.587px;">
                                            <div class="item"><img src="{{ optional($product->productImages->first())->file_name ? asset('storage/products/' . optional($product->productImages->first())->file_name) : asset('storage/products/default.png') }}" alt=""></div>
                                        </div>
                                        <div class="owl-item " style="width: 387.587px;">
                                            <div class="item"><img src="{{ optional($product->productImages->first())->file_name ? asset('storage/products/' . optional($product->productImages->first())->file_name) : asset('storage/products/default.png') }}" alt=""></div>
                                        </div>
                                        <div class="owl-item" style="width: 387.587px;">
                                            <div class="item"><img src="{{ optional($product->productImages->first())->file_name ? asset('storage/products/' . optional($product->productImages->first())->file_name) : asset('storage/products/default.png') }}" alt=""></div>
                                        </div>
                                        <div class="owl-item" style="width: 387.587px;">
                                            <div class="item"><img src="{{ optional($product->productImages->first())->file_name ? asset('storage/products/' . optional($product->productImages->first())->file_name) : asset('storage/products/default.png') }}" alt=""></div>
                                        </div>
                                        <div class="owl-item" style="width: 387.587px;">
                                            <div class="item"><img src="{{ optional($product->productImages->first())->file_name ? asset('storage/products/' . optional($product->productImages->first())->file_name) : asset('storage/products/default.png') }}" alt=""></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
                                <div class="owl-dots disabled"></div>
                            </div>
                            <div class="owl-carousel owl-theme owl-loaded owl-drag" id="sync2">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: 0.4s; width: 806px;">
                                        @if ($product->productImages && $product->productImages->isNotEmpty())
                                            @foreach ($product->productImages as $image)
                                                <div class="owl-item " style="width: 85.647px; margin-right: 15px;">
                                                    <div class="item">
                                                        <img src="{{ $image->file_name ? asset('storage/products/' . $image->file_name) : asset('storage/products/default.png') }}" alt="Product Image">
{{--                                                    <img src="{{ optional($product->productImages->first())->file_name ? asset('storage/products/' . optional($product->productImages->first())->file_name) : asset('storage/products/default.png') }}" alt="">--}}
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
                                <div class="owl-dots disabled"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--                <div class="col-xxl-4 col-md-6 box-col-12">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="product-slider owl-carousel owl-theme" id="sync1">--}}
{{--                                <div class="item">--}}
{{--                                    <img--}}
{{--                                         src="{{ optional($product->productImages->first())->file_name ? asset('storage/products/' . optional($product->productImages->first())->file_name) : asset('storage/products/default.png') }}"--}}
{{--                                         alt="Product">--}}
{{--                                </div>--}}
{{--                                <ul class="product-color">--}}
{{--                                    @foreach ($product->productImages as $image)--}}
{{--                                        <li>--}}
{{--                                            <div class="item">--}}
{{--                                                <img  style="" src="{{ optional($product->productImages->first())->file_name ? asset('storage/products/' . optional($product->productImages->first())->file_name) : asset('storage/products/default.png') }}" alt="">--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-xxl-8 box-col-9 order-xxl-0 order-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="product-page-details">
                                <h3>{{ $product->name_en .' | '. $product->name_ar }}</h3>
                            </div>
                            <div class="product-price">$00.00
                                <del>$000.00 </del>
                            </div>
                            <ul class="product-color">
                                @foreach ($productVariants as $productVariant)
                                    {{ $productVariant->weight }} {{ $productVariant->unit->name }}
                                    @if (!$loop->last) | @endif
                                @endforeach
                                <br>
{{--                                <li class="bg-primary"></li>--}}
{{--                                <li class="bg-secondary"></li>--}}
{{--                                <li class="bg-success"></li>--}}
{{--                                <li class="bg-info"></li>--}}
{{--                                <li class="bg-warning"></li>--}}
                            </ul>
                            <hr>
                            <p>
                                {{ $product->description_en .' | '. $product->description_ar }}
                            </p>
                            <hr>
                            <div>
                                <table class="product-page-width">
                                    <tbody>
                                    <tr>
                                        <td> <b>Brand &nbsp;&nbsp;&nbsp;:</b></td>
                                        <td>Pixelstrap</td>
                                    </tr>
                                    <tr>
                                        <td> <b>Availability &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</b></td>
                                        <td class="txt-success">In stock</td>
                                    </tr>
                                    <tr>
                                        <td> <b>Seller &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</b></td>
                                        <td>ABC</td>
                                    </tr>
                                    <tr>
                                        <td> <b>Fabric &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</b></td>
                                        <td>Cotton</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <h4 class="product-title">share it</h4>
                                </div>
                                <div class="col-md-8">
                                    <div class="product-icon">
                                        <ul class="product-social">
                                            <li class="d-inline-block"><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                            <li class="d-inline-block"><a href="https://accounts.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                            <li class="d-inline-block"><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                            <li class="d-inline-block"><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                            <li class="d-inline-block"><a href="https://rss.app/" target="_blank"><i class="fa fa-rss"></i></a></li>
                                        </ul>
                                        <form class="d-inline-block f-right"></form>
                                    </div>
                                </div>
                            </div>
{{--                            <hr>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-4">--}}
{{--                                    <h4 class="product-title">Rate Now</h4>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-8">--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <select id="u-rating-fontawesome" name="rating" autocomplete="off">--}}
{{--                                            <option value="1">1</option>--}}
{{--                                            <option value="2">2</option>--}}
{{--                                            <option value="3">3</option>--}}
{{--                                            <option value="4">4</option>--}}
{{--                                            <option value="5">5</option>--}}
{{--                                        </select><span>(250 review)</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <hr>--}}
                            <div class="m-t-15 btn-showcase"><a class="btn btn-primary" href="cart.html" title=""> <i class="fa fa-shopping-basket me-1"></i>Add To Cart</a><a class="btn btn-success" href="checkout.html" title=""> <i class="fa fa-shopping-cart me-1"></i>Buy Now</a><a class="btn btn-secondary" href="list-wish.html"> <i class="fa fa-heart me-1"></i>Add To WishList</a></div>
                        </div>
                    </div>
                </div>
{{--                <div class="col-xxl-3 col-md-6 box-col-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="filter-block">--}}
{{--                                <h3>Brand</h3>--}}
{{--                                <ul>--}}
{{--                                    <li>Clothing</li>--}}
{{--                                    <li>Bags</li>--}}
{{--                                    <li>Footwear</li>--}}
{{--                                    <li>Watches</li>--}}
{{--                                    <li>ACCESSORIES</li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="collection-filter-block">--}}
{{--                                <ul class="pro-services">--}}
{{--                                    <li>--}}
{{--                                        <div class="d-flex"><i data-feather="truck"></i>--}}
{{--                                            <div class="flex-grow-1">--}}
{{--                                                <h5>Free Shipping                                    </h5>--}}
{{--                                                <p>Free Shipping World Wide</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="d-flex"><i data-feather="clock"></i>--}}
{{--                                            <div class="flex-grow-1">--}}
{{--                                                <h5>24 X 7 Service                                    </h5>--}}
{{--                                                <p>Online Service For New Customer</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="d-flex"><i data-feather="gift"></i>--}}
{{--                                            <div class="flex-grow-1">--}}
{{--                                                <h5>Festival Offer                                 </h5>--}}
{{--                                                <p>New Online Special Festival</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <div class="d-flex"><i data-feather="credit-card"></i>--}}
{{--                                            <div class="flex-grow-1">--}}
{{--                                                <h5>Online Payment                                  </h5>--}}
{{--                                                <p>Contrary To Popular Belief.                                   </p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- silde-bar colleps block end here-->--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->



{{--        <div wire:ignore.self class="modal fade" id="productVariantsModal" tabindex="-1" role="dialog" aria-labelledby="productVariantsModal" aria-hidden="true">--}}
        <div wire:ignore.self wire:submit.prevent="createProductVariant" class="modal fade" id="productVariantsModal" tabindex="-1" role="dialog" aria-labelledby="productVariantsModal" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-toggle-wrapper social-profile text-start dark-sign-up">
                        <h3 class="modal-header justify-content-center border-0">Add Product Variant</h3>
                        <div class="modal-body">
                            <form class="row g-3 needs-validation" novalidate>
                                <input type="hidden" wire:model="product_id">
                                <div class="col-md-4">
                                    <label class="form-label" for="validationCustom01">weight</label>
                                    <input class="form-control" wire:model="weight" type="number" placeholder="Enter weight" required>
                                    @error('weight')
                                    <x-input-error class="mt-2" :messages="$message"/>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="validationCustom02">quantity</label>
                                    <input class="form-control" wire:model="quantity" type="number" placeholder="Enter quantity" required>
                                    @error('quantity')
                                    <x-input-error class="mt-2" :messages="$message"/>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <x-input-label for="status" :value="__('Status')"/>
                                    <select wire:model="status" id="status" name="status" class="form-control" autocomplete="status">
                                        <option value="" disabled>Select Status</option>
                                        @foreach(App\Models\ProductVariant::getStatusOptions() as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <x-input-error class="mt-2" :messages="$message"/>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <x-input-label for="Unit" :value="__('Unit')"/>
                                    <select wire:model="unit_id" id="unit_id" name="status" class="form-control" autocomplete="unit_id">
                                        <option value="" disabled>Select Unit</option>
                                        @foreach(App\Models\Unit::all() as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                    <x-input-error class="mt-2" :messages="$message"/>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="validationCustom01">Expiry Date</label>
                                    <input class="form-control" wire:model="expiry_date" type="date" placeholder="Enter expiry date" required>
                                    @error('expiry_date')
                                    <x-input-error class="mt-2" :messages="$message"/>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="validationCustom02">Expiry Date Alerts</label>
                                    <input class="form-control" wire:model="expiry_date_alerts" type="number" placeholder="Enter expiry_date_alerts" required>
                                    @error('expiry_date_alerts')
                                    <x-input-error class="mt-2" :messages="$message"/>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div wire:ignore.self wire:submit.prevent="createProductPacking" class="modal fade" id="productPackingModal" tabindex="-1" role="dialog" aria-labelledby="productPackingModal" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-toggle-wrapper social-profile text-start dark-sign-up">
                        <h3 class="modal-header justify-content-center border-0">Add Product Packing</h3>
                        <div class="modal-body">
                            <form class="row g-3 needs-validation" novalidate>
                                <input type="hidden" wire:model="product_id">
                                <div class="col-md-2">
                                    <label class="form-label" for="validationCustom01">Product Variant</label>
                                    <input class="form-control" wire:model="productVariantId" type="number" placeholder="Enter Product Variant" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" for="validationCustom02">quantity</label>
                                    <input class="form-control" wire:model="packing_quantity" type="number" placeholder="Enter quantity" required>
                                    @error('packing_quantity')
                                    <x-input-error class="mt-2" :messages="$message"/>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <x-input-label for="packing_level" :value="__('Status')"/>
                                    <select wire:model="packing_level" id="packing_level" name="packing_level" class="form-control" autocomplete="packing_level">
                                        <option value="" disabled>Select Status</option>
                                        @foreach(App\Models\ProductPacking::getPackagingLevel() as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <x-input-error class="mt-2" :messages="$message"/>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <x-input-label for="Unit" :value="__('Unit')"/>
                                    <select wire:model="unit_id" id="unit_id" name="status" class="form-control" autocomplete="unit_id">
                                        <option value="" disabled>Select Unit</option>
                                        @foreach(App\Models\Unit::all() as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                    <x-input-error class="mt-2" :messages="$message"/>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <x-input-label for="packaging_status" :value="__('Status')"/>
                                    <select wire:model="packaging_status" id="packaging_status" name="packaging_status" class="form-control" autocomplete="packaging_status">
                                        <option value="" disabled>Select Packing Status</option>
                                        @foreach(App\Models\ProductVariant::getStatusOptions() as $key => $value)
                                            <option value="{{ $key }}" {{ $key == $packaging_status ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('packaging_status')
                                    <x-input-error class="mt-2" :messages="$message"/>
                                    @enderror
                                </div>
                                <div class="col-md-2 mt-3">
                                    <x-input-label for="add" :value="__('Add')"/>
                                    <button class="btn btn-primary" type="submit">Add</button>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <table>
                                        <tr>
                                            <td>Packing</td>
                                            <td>Qty</td>
                                            <td>Statua</td>
                                        </tr>
                                        <tr>
                                            @foreach($productPackingDetails as $productPacking)
                                                <td>{{ $productPacking->packaging_level }}</td>
                                                <td>{{ $productPacking->quantity }}</td>
                                                <td>{{ $productPacking->status }}</td>
                                            @endforeach
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div>
{{--            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productVariantsModal">Add Variant</button>--}}

{{--            <table class="table">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Name</th>--}}
{{--                    <th>Price</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($productVariants as $variant)--}}
{{--                    <tr>--}}
{{--                        <td>{{ $variant->weight }}</td>--}}
{{--                        <td>{{ $variant->quantity }}</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
        </div>

{{--        @push('scripts')--}}
{{--            <script>--}}
{{--                window.addEventListener('closeModal', event => {--}}
{{--                    $('#productVariantsModal').modal('hide');--}}
{{--                });--}}
{{--            </script>--}}
{{--        @endpush--}}


{{--        <div  wire:submit.prevent="createProductVariant" class="modal fade" id="productVariantsModal" tabindex="-1" role="dialog" aria-labelledby="productVariantsModal" aria-hidden="true">--}}
{{--            <div class="modal-dialog modal-xl" role="document">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-toggle-wrapper social-profile text-start dark-sign-up">--}}
{{--                        <h3 class="modal-header justify-content-center border-0">Cion SIGN-UP</h3>--}}
{{--                        <div class="modal-body">--}}
{{--                            <form class="row g-3 needs-validation" novalidate="">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label class="form-label" for="validationCustom01">First name</label>--}}
{{--                                    <input class="form-control" name="product_id" id="validationCustom01" type="text" placeholder="Enter your name" required="">--}}
{{--                                    <div class="valid-feedback">Looks good!</div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label class="form-label" for="validationCustom02">Last name</label>--}}
{{--                                    <input class="form-control" name="unit_id" id="validationCustom02" type="text" placeholder="Enter your surname" required="">--}}
{{--                                    <div class="valid-feedback">Looks good!</div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label class="form-label" for="exampleFormControlInput1">Email address</label>--}}
{{--                                        <input class="form-control" name="weight" id="exampleFormControlInput1" type="email" placeholder="Ciontheme@gmail.com">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label class="form-label" for="exampleFormControlInput1">Email address</label>--}}
{{--                                        <input class="form-control" name="quantity" id="exampleFormControlInput1" type="email" placeholder="Ciontheme@gmail.com">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label class="form-label" for="exampleFormControlInput1">Email address</label>--}}
{{--                                        <input class="form-control" name="expiry_date" id="exampleFormControlInput1" type="email" placeholder="Ciontheme@gmail.com">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label class="form-label" for="exampleFormControlInput1">Email address</label>--}}
{{--                                        <input class="form-control" name="expiry_date" id="exampleFormControlInput1" type="email" placeholder="Ciontheme@gmail.com">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label class="form-label" for="exampleFormControlInput1">Email address</label>--}}
{{--                                        <input class="form-control" name="expiry_date_alerts" id="exampleFormControlInput1" type="email" placeholder="Ciontheme@gmail.com">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label class="form-label" for="exampleFormControlInput1">Email address</label>--}}
{{--                                        <input class="form-control" name="status" id="exampleFormControlInput1" type="email" placeholder="Ciontheme@gmail.com">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <div class="form-check mb-3">--}}
{{--                                        <input class="form-check-input" id="flexCheckDefault" type="checkbox" value="">--}}
{{--                                        <label class="form-check-label d-block mb-0" for="flexCheckDefault">You accept our Terms and Privacy Policy by clicking Submit below.</label>--}}
{{--                                    </div>--}}
{{--                                    <button class="btn btn-primary" type="submit">Sign Up</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}




    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid basic_table">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header text-end">
                        <h3 class="text-start">{{ __('Product Variants') }} List</h3>
                        <div id="basic-1_filter" class="dataTables_filter"><label>Search:<input type="search"  placeholder="" wire:keyup="searchProductVariant($event.target.value)" aria-controls="basic-1" style="border: 1px solid #efefef;padding: 0 10px;margin-left: 10px;height: 37px;border-radius: 0;"></label>
                        </div>
                    </div>
                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Expiry Date</th>
                                <th scope="col">Expiry Date Alerts</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($productVariants as $productVariant)
                            <tr wire:key="{{ $productVariant->id }}">
                                <td>{{ $productVariant->product->name_en }}</td>
                                <td>{{ $productVariant->user->name }}</td>
                                <td>{{ $productVariant->weight }} {{ $productVariant->unit->name }}</td>
                                <td>{{ $productVariant->quantity }}</td>
                                <td>{{ $productVariant->expiry_date }}</td>
                                <td>{{ $productVariant->expiry_date_alerts }}</td>
                                <td>
                                    <p class="text-{{ $productVariant->status ? 'success' : 'danger' }}">
                                        {{ $productVariant->getStatusOptions()[$productVariant->status] }}
                                    </p>
                                </td>
                                <td>
                                    <button class="btn btn-primary" type="button" wire:click="openProductPackingModal({{ $productVariant->id }})">
                                        Add Variant
                                    </button>

                                    <a wire:navigate href="{{ route('product-variants.show', $productVariant->id) }}">{{ __('Show') }}</a>
{{--                                    <a wire:navigate href="{{ route('product-variants.edit', $productVariant->id) }}">{{ __('Edit') }}</a>--}}
                                    <a wire:click="editProductVariant({{ $productVariant->id }})">{{ __('Edit') }}</a>
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



