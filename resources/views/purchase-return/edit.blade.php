<x-app-layout>
    <div class="page-body">
        <div class="container-fluid">
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid" style="padding-top: 24px;">
            <div class="edit-profile">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h3 class="card-title mb-0">Add New Stock<span class="f-m-light mt-1 text-danger error-message"></span></h3>
                                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header pb-0">
                                        </div>
                                        <form class="form theme-form dark-inputs" method="POST" action="{{ route('purchases-returns.update', $purchase->id) }}" id="frm-stock-in" >
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="purchase_id" value="{{ $purchase->id }}">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label for="search-prod">Find/Scan Product</label>
                                                        <select id="product_id" class="form-control product_id" name="product_id">
                                                            <option value="">Select Product</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label for="">Variants</label>
                                                        <select id="variant_id" name="variant_id" class="form-control variant_id">
                                                            <option value="">Select Product</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <div class="form-group">
                                                        <label for="">New Stock</label>
                                                        <input
                                                            type="number"
                                                            id="new_stock"
                                                            class="form-control new_stock"
                                                            placeholder="QTY"
                                                            value=""
                                                            name="new_stock">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label for="">Purchase Price</label>
                                                        <input
                                                            type="number"
                                                            id="purchase_price"
                                                            class="form-control purchase_price"
                                                            placeholder="purchase price"
                                                            value=""
                                                            name="purchase_price">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label for="">Sale Price</label>
                                                        <input
                                                            type="number"
                                                            id="sale_price"
                                                            class="form-control sale_price"
                                                            placeholder="sale price"
                                                            value=""
                                                            name="sale_price">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label for="">Expiry date</label>
                                                        <input
                                                            type="date"
                                                            class="form-control expiry_date"
                                                            placeholder="Expiry date"
                                                            value=""
                                                            name="expiry_date">
                                                    </div>
                                                </div>

                                                <div class="col-sm-1">
                                                    <div class="form-group">
                                                        <label for=""></label>
                                                        <a class="btn btn-success add-stock-to-list" style="margin-top: 30px;padding: 0.75rem 2rem;"  > <i class="fa fa-plus"></i> </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <button type="button" class="btn btn-info stock-in-btn" id="stock-in-btn" style="margin-top: 25px;padding: 0.75rem 2rem;" > Update stock </button>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label for="">Suppliers </label>
                                                        <select id="supplier_id" name="supplier_id" class="form-control supplier_id_select2">
                                                            <option value="" >Select Supplier</option>
                                                            @foreach($suppliers as $key => $supplier)
                                                                <option value="{{ $supplier->id }}" {{ $purchase->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label for="">Invoice #</label>
                                                        <input
                                                            type="number"
                                                            id="invoice_no"
                                                            class="form-control invoice_no"
                                                            placeholder="Invoice No"
                                                            value="{{ $purchase->invoice_no }}"
                                                            name="invoice_no">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label for="">Date</label>
                                                        <input
                                                            type="date"
                                                            class="form-control invoice_date"
                                                            value="{{ $purchase->invoice_date }}"
                                                            name="invoice_date"
                                                            id="invoice_date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <table class="table table-hover table-striped table-responsive invoice-table" id="tbl-invoice">
                                                    <thead style="border-bottom: 3px solid #338653;">
                                                    <th>Product</th>
                                                    <th>Variant</th>
                                                    <th>Purchase</th>
                                                    <th>Sale</th>
                                                    <th>New Stock</th>
                                                    <th>Expiry</th>
                                                    <th>Total</th>
                                                    <th>Remove</th>
                                                    </thead>
                                                    <tbody id="tbody">

                                                    @foreach($purchase->purchaseReturnItems as $item)
                                                        <tr>
                                                            <input type="hidden" name="purchase_item_ids[]" value="{{ $purchase->id }}">
                                                            <td>{{ $item->productVariant->product->name_en }}</td>
                                                            <td>{{ $item->productVariant->weight }} {{ $item->productVariant->unit->name }}</td>
                                                            <td><input type="number" name="purchase_prices[]" class="form-control" value="{{ $item->purchase_price }}" readonly></td>
                                                            <td><input type="number" name="sale_prices[]" class="form-control" value="{{ $item->sale_price }}" readonly></td>
                                                            <td><input type="number" name="new_stocks[]" class="form-control" value="{{ $item->quantity }}" readonly></td>
                                                            <td><input type="date" name="expiry_dates[]" class="form-control" value="{{ $item->expiry_date }}" readonly></td>
                                                            <td><input type="number" name="item_total[]" class="form-control" value="{{ $item->item_total }}" readonly></td>
                                                            <input type="hidden" name="variant_ids[]" value="{{ $item->product_variant_id }}">
                                                            <input type="hidden" name="product_ids[]" value="{{ $item->productVariant->product_id }}">
                                                            <td>
                                                                <div class=" p-0" style="margin-top: -2px;">
                                                                    <input id="checkbox1" type="checkbox" name="delete_items[]" value="{{ $item->id }}" class="delete-checkbox" data-item-total="{{ $item->item_total }}">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot class="footer-payments">
                                                    <td colspan="3">
                                                        <textarea name="particulars" cols="70" placeholder="Particulars" style="border-color: #374558;"></textarea>
                                                    </td>
                                                    <td>Old Total</td>
                                                    <td><input type="number" name="old_total" value="{{ $purchase->total_amount }}" readonly></td>
                                                    <td>Total</td>
                                                    <td><input type="number" class="total_bill" name="balance" readonly></td>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
    </div>
</x-app-layout>

<script>

    $(document).ready(function() {
        $('#product_id').select2({
            placeholder: 'Search for Product',
            minimumInputLength: 2,
            ajax: {
                url: '/search-products',
                dataType: 'json',
                delay: 100,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: function (params) {
                    return {
                        query: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.products, function (product) {
                            return {
                                id: product.id,
                                text: product.name_en
                            };
                        })
                    };
                },
                cache: true
            }
        });

        // When a product is selected, make another AJAX call to get the product variants
        $('#product_id').on('select2:select', function (e) {
            var selectedProductId = e.params.data.id;
            $.ajax({
                url: '/get-product-variants',
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    product_id: selectedProductId
                },
                success: function (response) {
                    var $variantsSelect = $('#variant_id'); // Assume you have another select with id 'variant_id'
                    $variantsSelect.empty();  // Clear previous options

                    $.each(response.variants, function (index, variant) {
                        var name = variant.weight + ' ' + variant.unit.name + ' - Qty ' + variant.quantity;
                        var option = new Option(name, variant.id);

                        $(option).data('purchase-price', variant.purchase_price);
                        $(option).data('sale-price', variant.sale_price);

                        // Append the option to the select element
                        $variantsSelect.append(option);
                    });

                    // Trigger Select2 update
                    $variantsSelect.trigger('change');
                    $variantsSelect.focus();
                },
                error: function (error) {
                    console.error('Error fetching product variants:', error);
                }
            });
        });

        $('#variant_id').on('change', function() {
            // Get the selected option
            var selectedOption = $(this).find('option:selected');

            // Retrieve the purchase and sale prices from the data attributes
            var purchasePrice = selectedOption.data('purchase-price');
            var salePrice = selectedOption.data('sale-price');

            // Assign the prices to the respective fields
            $('#purchase_price').val(purchasePrice);
            $('#sale_price').val(salePrice);
            $('#new_stock').focus();
        });

        // $('body').on('change','#variant_id',function() {
        //     $('#new_stock').focus();
        // });

        $('body').on('click', '.add-stock-to-list', handleItemsList);

        $('body').on('click','.delete-product',function(){
            var row = $(this).closest('tr');
            var totalPrice = parseFloat(row.find('.total_price').val());
            var totalBill = parseFloat($('.total_bill').val());

            if (!isNaN(totalPrice) && !isNaN(totalBill)) {
                var newTotal = totalBill - totalPrice;
                $('.total_bill').val(newTotal.toFixed(2));
            }
            $(this).closest('tr').remove();
        });

        $('#stock-in-btn').click(function(event) {
            if(handleFormSubmitValudation()) {
                $('#frm-stock-in').submit();
            }
        });

        // $('.delete-checkbox').change(function() {
        //     if ($(this).is(':checked')) {
        //         // Get the data-item-total value
        //         const itemTotal = $(this).data('item-total');
        //     }
        // });

    });


    function handleItemsList() {
        const product = {
            product_lbl: $("#product_id").find('option:selected').text(),
            product_id: $("#product_id").val(),
            variant_lbl: $('.variant_id').find('option:selected').text(),
            variant_id: $('.variant_id').val(),
            new_stock: $('.new_stock').val(),
            expiry_date: $('.expiry_date').val(),
            purchase_price: $('.purchase_price').val(),
            sale_price: $('.sale_price').val(),
        };

        if (validateStockInput(product)) {
            addStockInRow(product);
        } else {
            showErrorMessage('Please enter valid values for all fields!');
        }
    }

    function validateStockInput(product) {
        console.log(product);
        if (!product.product_id || !product.variant_id || !product.new_stock || !product.expiry_date || Number(product.purchase_price) <= 0 || Number(product.sale_price) <= 0) {
            return false;
        }
        return true;
    }

    const existingVariant_idIds = new Set();

    function addStockInRow(product) {
        $('.footer-payments').show();

        var total_bill = $(".total_bill").val() || 0;
        existingVariant_idIds.add(product.variant_id);

        trId = 1;
        var total_price = product.new_stock * product.purchase_price;
        total_bill = parseFloat(total_bill)+parseFloat(total_price);
        var row = `<tr id="tr-`+trId+`">
                            <input type="hidden" name="purchase_item_ids[]" value="1">
                            <input type="hidden" name="product_ids[]" class="product_ids" value="`+product.product_id+`">
                            <input type="hidden" name="variant_ids[]" class="variant_ids" value="`+product.variant_id+`">
                            <td><input type="text" class="form-control" value="`+product.product_lbl+`" disabled="disabled"></td>
                            <td><input type="text" class="form-control" value="`+product.variant_lbl+`" disabled="disabled"></td>
                            <td><input type="number" name="purchase_prices[]" class="form-control purchase_prices" value="`+product.purchase_price+`" readonly></td>
                            <td><input type="number"  name="sale_prices[]" class="form-control" value="`+product.sale_price+`" readonly></td>
                            <td><input type="number" name="new_stocks[]" class="form-control new_stocks" value="`+product.new_stock+`" readonly></td>
                            <td><input type="date" name="expiry_dates[]"  class="form-control expiry_dates" value="`+product.expiry_date+`" readonly></td>
                            <td><input type="number" name="item_total[]" class="form-control total_price" value="`+total_price+`" readonly></td>
                            <td>
                                <a class="delete-product"><i style="color: red;" class="fa fa-trash"></i></a>
                            </td>
                            <td></td>
                        </tr>`;
        $("#tbody").prepend(row);
        $('.total_bill').val(total_bill);
        trId++;
        document.getElementById("stock-in-btn").removeAttribute("disabled");
        clearForm();
        // }
        // else {
        //     const errorMessage = `Product ${product.product_lbl} already exists in list.`;
        //     showErrorMessage(errorMessage);
        // }
    }

    function handleFormSubmitValudation() {
        var validation = 1;

        var product_id = parseInt($('.product_id').find('option:selected').val());
        if(product_id === 0){
            const errorMessage = `Product Must Be Selected.`;
            showErrorMessage(errorMessage);
            return false;
        }

        if($("#supplier_id").val() === ''){
            const errorMessage = `Please Add supplier.`;
            showErrorMessage(errorMessage);
            return false;
        }

        if($("#invoice_no").val() === ''){
            const errorMessage = `Please Add invoice no.`;
            showErrorMessage(errorMessage);
            return false;
        }

        if($("#invoice_date").val() === ''){
            const errorMessage = `Please Add invoice date.`;
            showErrorMessage(errorMessage);
            return false;
        }

        // quantity
        $('.invoice-table').find(".new_stock").each(function() {
            var val = $(this).val();
            if(isNaN(val) || val == 0 || val == '')
                validation = 0;
        });

        if(validation == 1) {
            return true;
        }
        else {
            const errorMessage = `Please Complete all the Records Stock and QTY/Price must be greater then 0 in the list to submit.`;
            showErrorMessage(errorMessage);
            return false;
        }
    }

    function showErrorMessage(message) {
        const errorMessageElement = $('.error-message'); // Select the element with class "error-message"

        errorMessageElement.text(message);
        errorMessageElement.show();
        // Hide the error message after 30 seconds
        setTimeout(() => {
            errorMessageElement.hide();
        }, 30000); // 30 seconds in milliseconds
    }

    function clearForm(){
        $("#product_id").val('');
        $("#product_id").trigger('change');
        $('.variant_id').val('');
        $('.variant_id').empty();
        $('.new_stock').val('');
        $('.expiry_date').val('');
        $('.purchase_price').val('');
        $('.sale_price').val('');
        $('.total_qty_in_stock').val('');
        // $('.fabric_purchase_date').val(new Date().toISOString().slice(0, 10));
    }

</script>
