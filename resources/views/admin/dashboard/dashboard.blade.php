<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--            {{ __('Dashboard') }} admin--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 text-gray-900 dark:text-gray-100">--}}
{{--                    {{ __("You're logged in!") }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="page-body">
    <div class="container-fluid"></div>
    <!-- Container-fluid starts-->
    <div class="container-fluid dashboard_default">
        <div class="row widget-grid">
            <div class="col-12">
                <div class="page-title mt-2">
                    <div class="row">
                        <div class="col-sm-6 ps-0">
                            <h3>Shopping place Dashboard</h3>
                        </div>
                        <div class="col-sm-6 pe-0">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">
                                        <svg class="stroke-icon">
                                            <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                        </svg></a></li>
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">Default</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-sm-12 box-col-4">
                <div class="card total-earning">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-7 box-col-7">
                                <div class="d-flex">
                                    <div class="badge bg-light-primary badge-rounded font-primary me-2">$</div>
                                    <div class="flex-grow-1">
                                        <h3>Total Earning</h3>
                                    </div>
                                </div>
                                <h5>$20.790</h5>
                                <p class="d-flex"><span class="bg-light-secondary me-2">
                            <svg>
                              <use href="{{ asset('assets/svg/icon-sprite.svg#arrow-down') }}"></use>
                            </svg></span><span class="font-secondary me-2">- 36.28%</span><span>Since last month</span></p>
                            </div>
                            <div class="col-sm-5 box-col-5">
                                <div id="expensesChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-sm-12 box-col-4">
                <div class="card total-earning">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-7 box-col-7">
                                <div class="d-flex">
                                    <div class="badge bg-light-dark badge-rounded font-primary me-2">
                                        <svg>
                                            <use href="{{ asset('assets/svg/icon-sprite.svg#fill-Buy') }}"></use>
                                        </svg>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3>Total Sales</h3>
                                    </div>
                                </div>
                                <h5>$65.340</h5>
                                <p class="d-flex"><span class="bg-light-dark me-2">
                            <svg>
                              <use href="{{ asset('assets/svg/icon-sprite.svg#arrow-up') }}"></use>
                            </svg></span><span class="font-dark me-2">- 90.28%</span><span>Then last Week</span></p>
                            </div>
                            <div class="col-sm-5 box-col-5">
                                <div id="totalLikesAreaChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12 col-sm-12 box-col-4">
                <div class="card total-earning">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-7 box-col-7">
                                <div class="d-flex">
                                    <div class="badge bg-light-secondary badge-rounded font-primary me-2">
                                        <svg>
                                            <use href="{{ asset('assets/svg/icon-sprite.svg#user') }}"></use>
                                        </svg>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3>Total Visitors</h3>
                                    </div>
                                </div>
                                <h5>$46.564</h5>
                                <p class="d-flex"><span class="bg-light-secondary me-2">
                            <svg>
                              <use href="{{ asset('assets/svg/icon-sprite.svg#arrow-down') }}"></use>
                            </svg></span><span class="font-secondary me-2">- 25.28%</span><span>Since last month</span></p>
                            </div>
                            <div class="col-sm-5 box-col-5 incom-chart">
                                <div id="Incomechrt"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card invoice-card">
                    <div class="card-header pb-0">
                        <h3>Recent Orders</h3>
                    </div>
                    <div class="card-body transaction-card">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="recent-order" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Product Name</th>
                                    <th>Date</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>A8576</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0"><img src="{{ asset('assets/images/dashboard/user/01.png') }}" alt=""></div>
                                            <div class="flex-grow-1 ms-2"><a href="product-page.html">
                                                    <h4>Nike Sports</h4><span>Free delivery</span></a></div>
                                        </div>
                                    </td>
                                    <td>Aug 15,2023</td>
                                    <td>
                                        <button class="btn">Paid</button>
                                    </td>
                                    <td class="txt-warning">Delivered</td>
                                    <td>$44.54</td>
                                </tr>
                                <tr>
                                    <td>K6556</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0"><img src="{{ asset('assets/images/dashboard/user/02.png') }}" alt=""></div>
                                            <div class="flex-grow-1 ms-2"><a href="product-page.html">
                                                    <h4>Women Bag</h4><span>$83.97 delivery</span></a></div>
                                        </div>
                                    </td>
                                    <td>Aug 25,2023</td>
                                    <td>
                                        <button class="btn">Paid</button>
                                    </td>
                                    <td class="txt-primary">Pending</td>
                                    <td>$51.50</td>
                                </tr>
                                <tr>
                                    <td>Y6485</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0"><img src="{{ asset('assets/images/dashboard/user/03.png') }}" alt=""></div>
                                            <div class="flex-grow-1 ms-2"><a href="product-page.html">
                                                    <h4>Sunglasses</h4><span>Free delivery</span></a></div>
                                        </div>
                                    </td>
                                    <td>May 08,2023</td>
                                    <td>
                                        <button class="btn">Paid</button>
                                    </td>
                                    <td class="txt-danger">Cancel</td>
                                    <td>$64.16</td>
                                </tr>
                                <tr>
                                    <td>G5653</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0"><img src="{{ asset('assets/images/dashboard/user/04.png') }}" alt=""></div>
                                            <div class="flex-grow-1 ms-2"><a href="product-page.html">
                                                    <h4>Men T-shirt</h4><span>$12.55 delivery</span></a></div>
                                        </div>
                                    </td>
                                    <td>Feb 14,2023</td>
                                    <td>
                                        <button class="btn">Unpaid</button>
                                    </td>
                                    <td class="txt-warning">Delivered</td>
                                    <td>$35.95</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-6 box-col-3">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="card top-seller">
                            <div class="card-header card-no-border">
                                <div class="header-top">
                                    <h3 class="m-0">Top Seller</h3>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li>
                                                <div><i class="icon-settings"></i></div>
                                            </li>
                                            <li><i class="view-html fa fa-code"></i></li>
                                            <li><i class="icofont icofont-maximize full-card"></i></li>
                                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                                            <li><i class="icofont icofont-error close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="seller-top">
                                    <button>Trending</button>
                                    <h4>
                                        <svg>
                                            <use href="{ asset('assets/svg/icon-sprite.svg#location"></use>
                                        </svg>jail Road,Sylhet
                                    </h4>
                                </div>
                                <div class="user-details customers">
                                    <div>
                                        <h3>VK Enterprise</h3>
                                        <ul>
                                            <li class="d-inline-block"><img class="img-30 rounded-circle" src="{{ asset('assets/images/dashboard/user/09.jpg') }}" alt="user"></li>
                                            <li class="d-inline-block"><img class="img-30 rounded-circle" src="{{ asset('assets/images/dashboard/user/010.jpg') }}" alt="user"></li>
                                            <li class="d-inline-block"><img class="img-30 rounded-circle" src="{{ asset('assets/images/dashboard/user/011.jpg') }}" alt="user"></li>
                                            <li class="d-inline-block"><img class="img-30 rounded-circle" src="{{ asset('assets/images/dashboard/user/08.jpg') }}" alt="user"></li>
                                            <li class="d-inline-block">
                                                <div class="light-card"><span class="f-w-500">+5</span></div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="sale-improved">
                                        <h4>60% Sale</h4>
                                    </div>
                                </div>
                                <div class="code-box-copy">
                                    <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#top-seller"><i class="icofont icofont-copy-alt"></i></button>
                                    <pre><code class="language-html" id="top-seller">&lt;div class="card"&gt;
&lt;div class="card-header card-no-border"&gt;
  &lt;div class="header-top"&gt;
     &lt;h4&gt; Top Seller&lt;/h4&gt;
  &lt;div class="card-header-right"&gt;
    &lt;ul class="list-unstyled card-option&gt;
      &lt;li&gt;&lt;div class="setting-light"&gt;&lt;i class="icon-layout-grid2"&gt;&lt;/i&gt;&lt;/div&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="view-html fa fa-code font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-maximize full-card font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-minus minimize-card font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-refresh reload-card font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-error close-card font-white"&gt; &lt;/i&gt;&lt;/li&gt;
    &lt;/ul&gt;
  &lt;/div&gt;
   &lt;div class="card-body pt-0"&gt;
    &lt;div class="seller-top"&gt;
      &lt;button&gt; Trending;
      &lt;h4&gt;
        &lt;svg&gt;
          &lt;use href="../assets/svg/icon-sprite.svg#fill-Buy"&gt;
        &lt;/svg&gt;
        jail Road,Sylhet
      &lt;/h4&gt;
    &lt;/div&gt;
    &lt;div class="user-details customers"&gt;
      &lt;div&gt;
        &lt;h3&gt; VK Enterprise&lt;/h4&gt;
        &lt;ul&gt;
          &lt;li class="d-inline-block"&gt;
            &lt;img class="img-40 rounded-circle" src="../assets/images/dashboard/user/09.jpg" alt="user"&gt;
          &lt;/li&gt;
          &lt;li class="d-inline-block"&gt;
            &lt;img class="img-40 rounded-circle" src="../assets/images/dashboard/user/010.jpg" alt="user"&gt;
          &lt;/li&gt;
          &lt;li class="d-inline-block"&gt;
            &lt;img class="img-40 rounded-circle" src="../assets/images/dashboard/user/011.jpg" alt="user"&gt;
          &lt;/li&gt;
          &lt;li class="d-inline-block"&gt;
            &lt;img class="img-40 rounded-circle" src="../assets/images/dashboard/user/08.jpg" alt="user"&gt;
          &lt;/li&gt;
          &lt;li class="d-inline-block"&gt;
            &lt;div class="light-card"&gt;
              &lt;span class="f-w-500"&gt;+5&lt;/span&gt;
            &lt;/div&gt;
          &lt;/li&gt;
        &lt;/ul&gt;
      &lt;/div&gt;
      &lt;div class="sale-improved"&gt;
        &lt;h4&gt; 60%&lt;/h4&gt;
      &lt;/div&gt;
     &lt;/div&gt;</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="card selling-product">
                            <div class="card-header card-no-border">
                                <div class="header-top">
                                    <h3 class="m-0">Top Selling Product</h3>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <ul class="selling-box bg-light-primary">
                                    <li>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0"><img src="{{ asset('assets/images/dashboard/04.png') }}" alt=""></div>
                                            <div class="flex-grow-1"> <a href="product-page.html">
                                                    <h4>Bluetooth-Handphone</h4>
                                                    <p>Welltech SH 12 Bluetooth Headphone Bluetooth</p></a>
                                                <div class="d-flex align-items-center gap-0">
                                                    <h4>4.5</h4>
                                                    <p class="pull-right ms-2"><i class="fa fa-star font-secondary"></i></p>
                                                </div>
                                            </div><a href="cart.html"><span>
                                  <svg>
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-Buy') }}"></use>
                                  </svg></span></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 box-col-3">
                <div class="card">
                    <div class="card-header card-no-border pb-0">
                        <div class="header-top">
                            <h3 class="m-0">New Product</h3>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li>
                                        <div><i class="icon-settings"></i></div>
                                    </li>
                                    <li><i class="view-html fa fa-code"></i></li>
                                    <li><i class="icofont icofont-maximize full-card"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                                    <li><i class="icofont icofont-error close-card"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0 product-card">
                        <div class="table-responsive theme-scrollbar">
                            <table class="table display" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex"><img src="{{ asset('assets/images/dashboard/10.jpg') }}" alt="">
                                            <div class="flex-grow-1 ms-2"><a href="product-page.html"><span>Pot</span>
                                                    <h5>100 </h5></a></div>
                                            <div class="active-status active-online"></div>
                                        </div>
                                    </td>
                                    <td> <span>Coupon Code</span>
                                        <h5>1PIX001</h5>
                                    </td>
                                    <td>    <span>-65%</span>
                                        <h5>$99.00</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex"><img src="{{ asset('assets/images/dashboard/11.jpg') }}" alt="">
                                            <div class="flex-grow-1 ms-2"><a href="product-page.html"><span>iphone</span>
                                                    <h5>150 Item</h5></a></div>
                                            <div class="active-status active-online"></div>
                                        </div>
                                    </td>
                                    <td> <span>Coupon Code</span>
                                        <h5>HT463</h5>
                                    </td>
                                    <td>    <span>-15%</span>
                                        <h5>$65.00</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex"><img src="{{ asset('assets/images/dashboard/12.jpg') }}" alt="">
                                            <div class="flex-grow-1 ms-2"><a href="product-page.html"><span>Headphone</span>
                                                    <h5>513 Item</h5></a></div>
                                            <div class="active-status active-online"></div>
                                        </div>
                                    </td>
                                    <td> <span>Coupon Code</span>
                                        <h5>LP72K</h5>
                                    </td>
                                    <td>    <span>-92%</span>
                                        <h5>$84.00</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex"><img src="{{ asset('assets/images/dashboard/13.jpg') }}" alt="">
                                            <div class="flex-grow-1 ms-2"><a href="product-page.html"><span>Glass</span>
                                                    <h5>629 Item</h5></a></div>
                                            <div class="active-status active-online"></div>
                                        </div>
                                    </td>
                                    <td> <span>Coupon Code</span>
                                        <h5>REA75</h5>
                                    </td>
                                    <td>    <span>-37%</span>
                                        <h5>$24.00</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex"><img src="{{ asset('assets/images/dashboard/14.jpg') }}" alt="">
                                            <div class="flex-grow-1 ms-2"><a href="product-page.html"><span>Watch</span>
                                                    <h5>896 Item</h5></a></div>
                                            <div class="active-status active-online"></div>
                                        </div>
                                    </td>
                                    <td> <span>Coupon Code</span>
                                        <h5>XRT839</h5>
                                    </td>
                                    <td>    <span>-91%</span>
                                        <h5>$91.00</h5>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="code-box-copy">
                            <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#product-card"><i class="icofont icofont-copy-alt"></i></button>
                            <pre><code class="language-html" id="product-card">&lt;div class="card"&gt;
&lt;div class="card-header card-no-border pb-0"&gt;
  &lt;div class="header-top"&gt;
     &lt;h3 class="m-0"&gt; Top Seller&lt;/h3&gt;
  &lt;div class="card-header-right"&gt;
    &lt;ul class="list-unstyled card-option&gt;
      &lt;li&gt;&lt;div class="setting-light"&gt;&lt;i class="icon-layout-grid2"&gt;&lt;/i&gt;&lt;/div&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="view-html fa fa-code font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-maximize full-card font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-minus minimize-card font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-refresh reload-card font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-error close-card font-white"&gt; &lt;/i&gt;&lt;/li&gt;
    &lt;/ul&gt;
  &lt;/div&gt;
   &lt;div class="card-body pt-0 product-card"&gt;
    &lt;div class="table-responsive theme-scrollbar"&gt;
      &lt;table class="table display" style="width:100%"&gt;
        &lt;thead&gt;
          &lt;tr&gt;
            &lt;th&gt;Name&lt;/th&gt;
            &lt;th&gt;Code&lt;/th&gt;
            &lt;th&gt;price&lt;/th&gt;
          &lt;/tr&gt;
        &lt;/thead&gt;
        &lt;tbody&gt;
          &lt;tr&gt;
            &lt;td&gt;
              &lt;div class="d-flex"&gt;
                &lt;img src="../assets/images/dashboard/10.jpg"&gt;
                &lt;div class="flex-grow-1 ms-2"&gt;
                  &lt;a href="product-page.html"&gt;
                    &lt;h5&gt;Pot&lt;/h5&gt;
                    &lt;span&gt;100&lt;/span&gt;
                  &lt;/a&gt;
                &lt;/div&gt;
                &lt;div class="active-status active-online"&gt;
              &lt;/div&gt;
            &lt;/td&gt;
            &lt;td&gt;
              &lt;h5&gt;Coupon Code&lt;/h5&gt;
              &lt;span&gt;1PIX001&lt;/span&gt;
            &lt;/td&gt;
            &lt;td&gt;
              &lt;h5&gt;-65%&lt;/h5&gt;
              &lt;span&gt;$99.00&lt;/span&gt;
            &lt;/td&gt;
          &lt;tr&gt;
            &lt;td&gt;
              &lt;div class="d-flex"&gt;
                &lt;img src="../assets/images/dashboard/11.jpg"&gt;
                &lt;div class="flex-grow-1 ms-2"&gt;
                  &lt;a href="product-page.html"&gt;
                    &lt;h5&gt;iphone&lt;/h5&gt;
                    &lt;span&gt;150 Item&lt;/span&gt;
                  &lt;/a&gt;
                &lt;/div&gt;
                &lt;div class="active-status active-online"&gt;
              &lt;/div&gt;
            &lt;/td&gt;
            &lt;td&gt;
              &lt;h5&gt;Coupon Code&lt;/h5&gt;
              &lt;span&gt;HT463&lt;/span&gt;
            &lt;/td&gt;
            &lt;td&gt;
              &lt;h5&gt;-15%&lt;/h5&gt;
              &lt;span&gt;$65.00&lt;/span&gt;
            &lt;/td&gt;
          &lt;tr&gt;
            &lt;td&gt;
              &lt;div class="d-flex"&gt;
                &lt;img src="../assets/images/dashboard/12.jpg"&gt;
                &lt;div class="flex-grow-1 ms-2"&gt;
                  &lt;a href="product-page.html"&gt;
                    &lt;h5&gt;Headphone&lt;/h5&gt;
                    &lt;span&gt;513 Item&lt;/span&gt;
                  &lt;/a&gt;
                &lt;/div&gt;
                &lt;div class="active-status active-online"&gt;
              &lt;/div&gt;
            &lt;/td&gt;
            &lt;td&gt;
              &lt;h5&gt;Coupon Code&lt;/h5&gt;
              &lt;span&gt;LP72K&lt;/span&gt;
            &lt;/td&gt;
            &lt;td&gt;
              &lt;h5&gt;-92%&lt;/h5&gt;
              &lt;span&gt;$84.00&lt;/span&gt;
            &lt;/td&gt;
          &lt;tr&gt;
            &lt;td&gt;
              &lt;div class="d-flex"&gt;
                &lt;img src="../assets/images/dashboard/10.jpg"&gt;
                &lt;div class="flex-grow-1 ms-2"&gt;
                  &lt;a href="product-page.html"&gt;
                    &lt;h5&gt;Glass&lt;/h5&gt;
                    &lt;span&gt;629 Item&lt;/span&gt;
                  &lt;/a&gt;
                &lt;/div&gt;
                &lt;div class="active-status active-online"&gt;
              &lt;/div&gt;
            &lt;/td&gt;
            &lt;td&gt;
              &lt;h5&gt;Coupon Code&lt;/h5&gt;
              &lt;span&gt;REA75&lt;/span&gt;
            &lt;/td&gt;
            &lt;td&gt;
              &lt;h5&gt;-37%&lt;/h5&gt;
              &lt;span&gt;$24.00&lt;/span&gt;
            &lt;/td&gt;
          &lt;tr&gt;
            &lt;td&gt;
              &lt;div class="d-flex"&gt;
                &lt;img src="../assets/images/dashboard/10.jpg"&gt;
                &lt;div class="flex-grow-1 ms-2"&gt;
                  &lt;a href="product-page.html"&gt;
                    &lt;h5&gt;Watch&lt;/h5&gt;
                    &lt;span&gt;896 Item&lt;/span&gt;
                  &lt;/a&gt;
                &lt;/div&gt;
                &lt;div class="active-status active-online"&gt;
              &lt;/div&gt;
            &lt;/td&gt;
            &lt;td&gt;
              &lt;h5&gt;Coupon Code&lt;/h5&gt;
              &lt;span&gt;XRT839&lt;/span&gt;
            &lt;/td&gt;
            &lt;td&gt;
              &lt;h5&gt;-91%&lt;/h5&gt;
              &lt;span&gt;$91.00&lt;/span&gt;
            &lt;/td&gt;</code></pre>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-md-6 box-col-4">
                <div class="card use-country">
                    <div class="card-header pb-0">
                        <h3 class="m-0">Top Countries</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li>
                                    <div><i class="icon-settings"></i></div>
                                </li>
                                <li><i class="view-html fa fa-code"></i></li>
                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                <li><i class="icofont icofont-error close-"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body mt-0 state">
                        <ul class="d-flex">
                            <li class="light-card balance-card bg-light-primary"><img src="{{ asset('assets/images/dashboard/04.jpg') }}" alt="">
                                <div class="Countries"><span class="rounded-pill badge-primary"></span>
                                    <h5>Uniter States</h5>
                                    <h6 class="mt-1 mb-0">60%</h6>
                                </div>
                            </li>
                            <li class="light-card balance-card bg-light-secondary"><img src="{{ asset('assets/images/dashboard/05.jpg') }}" alt="">
                                <div class="Countries"><span class="rounded-pill badge-secondary"></span>
                                    <h5>Germany</h5>
                                    <h6 class="mt-1 mb-0">51%</h6>
                                </div>
                            </li>
                            <li class="light-card balance-card bg-light-dark"><img src="{{ asset('assets/images/dashboard/06.jpg') }}" alt="">
                                <div class="Countries"><span class="rounded-pill badge-dark"></span>
                                    <h5>New Zealand</h5>
                                    <h6 class="mt-1 mb-0">52%</h6>
                                </div>
                            </li>
                            <li class="light-card balance-card bg-light-warning"><img src="{{ asset('assets/images/dashboard/07.jpg') }}" alt="">
                                <div class="Countries"><span class="rounded-pill badge-warning"></span>
                                    <h5>Australia</h5>
                                    <h6 class="mt-1 mb-0">62%</h6>
                                </div>
                            </li>
                        </ul>
                        <div class="col-xl-12 mt-4">
                            <div class="jvector-map-height" id="asia"></div>
                        </div>
                        <div class="code-box-copy">
                            <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#use-country"><i class="icofont icofont-copy-alt"></i></button>
                            <pre><code class="language-html" id="use-country">&lt;div class="card use-country"&gt;
&lt;div class="card-header"&gt;
  &lt;h3 class="m-0"&gt;Top Countries&lt;/h3&gt;
  &lt;div class="card-header-right"&gt;
    &lt;ul class="list-unstyled card-option&gt;
      &lt;li&gt;&lt;div class="setting-light"&gt;&lt;i class="icon-layout-grid2"&gt;&lt;/i&gt;&lt;/div&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="view-html fa fa-code font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-maximize full-card font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-minus minimize-card font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-refresh reload-card font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-error close-card font-white"&gt; &lt;/i&gt;&lt;/li&gt;
    &lt;/ul&gt;
  &lt;/div&gt;
&lt;/div&gt;
&lt;div class="card-body mt-0 state"&gt;
  &lt;ul class="d-flex"&gt;
    &lt;li&gt;
      &lt;img src="../assets/images/dashboard/04.jpg"/&gt;
      &lt;div class="Countries"&gt;
        &lt;span class="rounded-pill badge-primary"&gt;
        &lt;h5"&gt;&lt;Uniter States&gt;
        &lt;h6 class="mt-1 mb-0"&gt;&lt;60%&gt;
      &lt;/div&gt;
    &lt;/li&gt;
    &lt;li&gt;
      &lt;img src="../assets/images/dashboard/05.jpg"/&gt;
      &lt;div class="Countries"&gt;
        &lt;span class="rounded-pill badge-primary"&gt;
        &lt;h5"&gt;&lt;Germany&gt;
        &lt;h6 class="mt-1 mb-0"&gt;&lt;51%&gt;
      &lt;/div&gt;
    &lt;/li&gt;
    &lt;li&gt;
      &lt;img src="../assets/images/dashboard/06.jpg"/&gt;
      &lt;div class="Countries"&gt;
        &lt;span class="rounded-pill badge-primary"&gt;
        &lt;h5"&gt;&lt;New Zealand&gt;
        &lt;h6 class="mt-1 mb-0"&gt;&lt;52%&gt;
      &lt;/div&gt;
    &lt;/li&gt;
    &lt;li&gt;
      &lt;img src="../assets/images/dashboard/07.jpg"/&gt;
      &lt;div class="Countries"&gt;
        &lt;span class="rounded-pill badge-primary"&gt;
        &lt;h5"&gt;&lt;Australia&gt;
        &lt;h6 class="mt-1 mb-0"&gt;&lt;62%&gt;
      &lt;/div&gt;
    &lt;/li&gt;
  &lt;/ul&gt;
  &lt;div class="col-xl-12"&gt;
    &lt;div class="jvector-map-height" id="asia"&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-md-6 box-col-4 notification">
                <div class="card">
                    <div class="card-header pb-0">
                        <h3 class="m-0">Activity Timeline</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li>
                                    <div><i class="icon-settings"></i></div>
                                </li>
                                <li><i class="view-html fa fa-code"></i></li>
                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                <li><i class="icofont icofont-error close-"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="activity-timeline">
                            <div class="d-flex align-items-start">
                                <div class="activity-line"></div>
                                <div class="activity-dot-primary"></div>
                                <div class="flex-grow-1">
                                    <p class="todo-font"><span class="font-primary">30-06-2023</span>Today</p><span class="f-w-700">Updated Product</span>
                                    <p class="mb-0">Quisque a consequat ante sit amet.</p>
                                </div><i class="fa fa-circle circle-dot-primary pull-right"></i>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="activity-dot-dark"></div>
                                <div class="flex-grow-1">
                                    <p class="todo-font"><span class="font-dark">30-06-2023</span>Today</p><span class="f-w-700">James just like your product</span>
                                    <p class="mb-0">Design and style should work toward making look good.</p>
                                </div><i class="fa fa-circle circle-dot-dark pull-right"></i>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="activity-dot-secondary"></div>
                                <div class="flex-grow-1">
                                    <p class="todo-font"><span class="font-secondary">25-06-2023</span>Today<span class="badge badge-secondary ms-2">New</span></p><span class="f-w-700">Jihan Doe just like your product</span>
                                    <p>If you have it, you can make anything look good.</p>
                                    <ul class="img-wrapper">
                                        <li> <img class="img-30 img-fluid" src="{{ asset('assets/images/dashboard/04.png') }}" alt=""></li>
                                        <li><img class="img-fluid" src="{{ asset('assets/images/dashboard/09.png') }}" alt=""></li>
                                    </ul>
                                </div><i class="fa fa-circle circle-dot-secondary pull-right"></i>
                            </div>
                        </div>
                        <div class="code-box-copy">
                            <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#activity1"><i class="icofont icofont-copy-alt"></i></button>
                            <pre><code class="language-html" id="activity1">&lt;div class="card"&gt;
  &lt;div class="card-header pb-0"&gt;
    &lt;div class="d-flex justify-content-between"&gt;
      &lt;div class="flex-grow-1"&gt;
        &lt;h3&gt; Activity Timeline&lt;/h4&gt;
      &lt;/div&gt;
      &lt;div class="setting-list"&gt;
        &lt;ul class="list-unstyled setting-option"&gt;
          &lt;li&gt;&lt;div class="setting-light"&gt;&lt;i class="icon-layout-grid2"&gt;&lt;/i&gt;&lt;/div&gt;&lt;/li&gt;
          &lt;li&gt;&lt;i class="view-html fa fa-code font-white"&gt;&lt;/i&gt;&lt;/li&gt;
          &lt;li&gt;&lt;i class="icofont icofont-maximize full-card font-white"&gt;&lt;/i&gt;&lt;/li&gt;
          &lt;li&gt;&lt;i class="icofont icofont-minus minimize-card font-white"&gt;&lt;/i&gt;&lt;/li&gt;
          &lt;li&gt;&lt;i class="icofont icofont-refresh reload-card font-white"&gt;&lt;/i&gt;&lt;/li&gt;
          &lt;li&gt;&lt;i class="icofont icofont-error close-card font-white"&gt; &lt;/i&gt;&lt;/li&gt;
        &lt;/ul&gt;
      &lt;/div&gt;
    &lt;/div&gt;
  &lt;/div&gt;
  &lt;div class="card-body"&gt;
    &lt;div class="activity-timeline"&gt;
      &lt;div class="d-flex align-items-start"&gt;
        &lt;div class="activity-line"&gt;&lt;/div&gt;
        &lt;div class="activity-dot-secondary"&gt;&lt;/div&gt;
        &lt;div class="flex-grow-1"&gt;
          &lt;p class="todo-font mt-0"&gt; Today
            &lt;span class="font-primary"&gt; 30-06-2023 &lt;/span&gt;
          &lt;/p &gt;
          &lt;span class="f-w-700" Updated Product
          &lt;p class="mb-0"&gt; Quisque a consequat ante sit amet. &lt;/p&gt;
        &lt;/div&gt;
        &lt;i class="fa fa-circle circle-dot-secondary pull-right"&gt;&lt;/i&gt;
      &lt;/div&gt;
      &lt;div class="d-flex align-items-start"&gt;
        &lt;div class="activity-dot-secondary"&gt;&lt;/div&gt;
        &lt;div class="flex-grow-1"&gt;
          &lt;p class="mt-0 todo-font"&gt;
            &lt;span class="font-primary"&gt; 25-06-2023 &lt;/span&gt;
            Today
          &lt;/p &gt;
          &lt;span class="f-w-700"&gt; Jihan Doe just like your product
          &lt;/span&gt;
          &lt;p class="mb-0"&gt; If you have it, you can make anything look good. &lt;/p&gt;
        &lt;/div&gt;
        &lt;i class="fa fa-circle circle-dot-secondary pull-right"&gt;&lt;/i&gt;
      &lt;/div&gt;
      &lt;div class="d-flex align-items-start"&gt;
        &lt;div class="activity-dot-primary"&gt;&lt;/div&gt;
        &lt;div class="flex-grow-1"&gt;
          &lt;p class="todo-font mt-0"&gt;
            &lt;span class="font-primary"&gt; 30-06-2023 &lt;/span&gt;
            Today
            &lt;span class="badge badge-primary ms-2"&gt; New &lt;/span&gt;
          &lt;/p &gt;
          &lt;span class="f-w-700"&gt; James just like your product &lt;/span&gt;
          &lt;p&gt; Design and style should work toward making look good. &lt;/p&gt;
          &lt;ul&gt;
            &lt;li&gt;
              &lt;img class="img-fluid" src="../assets/images/dashboard/04.png" alt=""/&gt;
            &lt;/li&gt;
            &lt;li&gt;
              &lt;img class="img-fluid" src="../assets/images/dashboard/09.png" alt=""/&gt;
            &lt;/li&gt;
          &lt;/ul&gt;
          &lt;i class="fa fa-circle circle-dot-secondary pull-right"&gt;&lt;/i&gt;
        &lt;/div&gt;
      &lt;/div&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt; </code></pre>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-4 col-md-12 box-col-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h3 class="m-0">Sales Summary</h3>
                    </div>
                    <div class="card-body p-0">
                        <div id="area-line"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12 box-col-4">
                <div class="card weekend-card">
                    <div class="card-body"><img class="w-100 mb-3" src="{{ asset('assets/images/dashboard/01.png') }}" alt="">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0"><a href="product-page.html"><span>Weekend Sale</span>
                                    <p>Acer Aspire 5 Gaming Intel Core</p></a>
                                <div class="d-flex align-items-center">
                                    <h4>4.5</h4><span class="pull-right ms-2"><i class="fa fa-star font-secondary"></i></span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <button class="btn">Hot</button>
                                <div class="weekend-price">$26.00
                                    <del>$30.00</del>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12 box-col-4">
                <div class="card weekend-card">
                    <div class="card-body"><img class="w-100 mb-3" src="{{ asset('assets/images/dashboard/02.png') }}" alt="">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0"><a href="product-page.html"><span>Special Offer</span>
                                    <p>Airpods 3rd Generation Silicone</p></a>
                                <div class="d-flex align-items-center">
                                    <h4>4.5</h4><span class="pull-right ms-2"><i class="fa fa-star font-secondary"></i></span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <button class="btn">50%</button>
                                <div class="weekend-price">$41.00
                                    <del>$45.00</del>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12 box-col-4">
                <div class="card weekend-card">
                    <div class="card-body"><img class="w-100 mb-3" src="{{ asset('assets/images/dashboard/03.png') }}" alt="">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0"><a href="product-page.html"><span>Best Flash Sale</span>
                                    <p> Smartwatch with Alexa Built-in</p></a>
                                <div class="d-flex align-items-center">
                                    <h4>4.5</h4><span class="pull-right ms-2"><i class="fa fa-star font-secondary"></i></span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <button class="btn">Hot</button>
                                <div class="weekend-price">$34.00
                                    <del>$32.00</del>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-sm-12 box-col-8e order-xl-1 order-md-2">
                <div class="card invoice-card">
                    <div class="card-header">
                        <h3>Invoice</h3>
                    </div>
                    <div class="card-body pt-0 manageorder">
                        <div class="table-responsive theme-scrollbar">
                            <table class="table display" id="information" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Create</th>
                                    <th>Due</th>
                                    <th>Amount</th>
                                    <th>Sent</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center"><img src="{{ asset('assets/images/dashboard/user/05.jpg') }}" alt="">
                                            <div class="flex-grow-1 ms-2"><a href="product-page.html">
                                                    <h5>Eleanor Pena</h5><span>IHC7456-08086</span></a></div>
                                        </div>
                                    </td>
                                    <td>Aug 15,2023</td>
                                    <td>Aug 18,2023 </td>
                                    <td>$6,05,654</td>
                                    <td>01</td>
                                    <td>
                                        <button class="btn">Done</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex"><img src="{{ asset('assets/images/dashboard/user/06.jpg') }}" alt="">
                                            <div class="flex-grow-1 ms-2"><a href="product-page.html">
                                                    <h5>Arlene Mccoy</h5><span>IHC7456-08086</span></a></div>
                                        </div>
                                    </td>
                                    <td>Aug 25,2023</td>
                                    <td>Aug 30,2023</td>
                                    <td>$5,55,456</td>
                                    <td>04</td>
                                    <td>
                                        <button class="btn">Pending</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex"><img src="{{ asset('assets/images/dashboard/user/07.jpg') }}" alt="">
                                            <div class="flex-grow-1 ms-2"><a href="product-page.html">
                                                    <h5>Devon Lane</h5><span>IHC7456-08086</span></a></div>
                                        </div>
                                    </td>
                                    <td>May 08,2023</td>
                                    <td>May 20,2023</td>
                                    <td>$2,98,852</td>
                                    <td>06</td>
                                    <td>
                                        <button class="btn">Done</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex"><img src="{{ asset('assets/images/dashboard/user/08.jpg') }}" alt="">
                                            <div class="flex-grow-1 ms-2"><a href="product-page.html">
                                                    <h5>Ronald Richards</h5><span>IHC7456-08086</span></a></div>
                                        </div>
                                    </td>
                                    <td>Feb 14,2023</td>
                                    <td>Feb 26,2023</td>
                                    <td>$3,56,158</td>
                                    <td>03</td>
                                    <td>
                                        <button class="btn">In Progress</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-sm-12 box-col-4 order-xl-1">
                <div class="card product-chart">
                    <div class="card-header pb-0">
                        <div class="header-top">
                            <h3 class="m-0">Product Sales</h3>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li>
                                        <div><i class="icon-settings"></i></div>
                                    </li>
                                    <li><i class="view-html fa fa-code"></i></li>
                                    <li><i class="icofont icofont-maximize full-card"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                                    <li><i class="icofont icofont-error close-card"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="d-flex">
                            <h3 class="me-2">$12,000</h3><span>(15,080 To Goal)</span>
                        </div>
                        <div id="product-sales"></div>
                        <div class="code-box-copy">
                            <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#product-chart"><i class="icofont icofont-copy-alt"></i></button>
                            <pre><code class="language-html" id="product-chart">&lt;div class="card product-chart"&gt;
&lt;div class="card-header pb-0"&gt;
  &lt;div class="header-top"&gt;
     &lt;h3 class="m-0"&gt; Product Sales&lt;/h3&gt;
  &lt;div class="card-header-right"&gt;
    &lt;ul class="list-unstyled card-option&gt;
      &lt;li&gt;&lt;div class="setting-light"&gt;&lt;i class="icon-layout-grid2"&gt;&lt;/i&gt;&lt;/div&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="view-html fa fa-code font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-maximize full-card font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-minus minimize-card font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-refresh reload-card font-white"&gt;&lt;/i&gt;&lt;/li&gt;
      &lt;li&gt;&lt;i class="icofont icofont-error close-card font-white"&gt; &lt;/i&gt;&lt;/li&gt;
    &lt;/ul&gt;
  &lt;/div&gt;
  &lt;div class="card-body pb-0"&gt;
    &lt;div class="d-flex"&gt;
      &lt;h3 class="me-2"&gt;$12,000&lt;/h3&gt;
      &lt;span&gt;(15,080 To Goal)&lt;/span&gt;
    &lt;/div&gt;
    &lt;div id="product-sales"&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
