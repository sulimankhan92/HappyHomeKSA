<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $order->id }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <style>
        /* Your existing CSS remains exactly the same */
        body {
            /*font-family: 'DejaVu Sans', sans-serif;*/

            font-family: 'Noto Sans Arabic', 'DejaVu Sans', sans-serif;

            font-size: 12px;
            color: #333;
            line-height: 1.4;
            padding: 1px;
        }

        .invoice-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .header-table {
            width: 100%;
            border-bottom: 2px solid #e0e0e0;
        }

        .header-table td {
            padding: 0;
        }

        .invoice-info h2 {
            margin: 0 0 5px;
            font-size: 20px;
        }

        .invoice-info p {
            margin: 2px 0;
        }

        .logo {
            max-height: 80px;
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }

        th {
            text-align: left;
            padding: 8px;
            background: #f5f5f5;
        }

        td {
            padding: 8px;
            vertical-align: top;
        }

        .item-image {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .totals {
            float: right;
            width: 170px;
            margin-top: 15px;
            padding-top: 10px;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 0px 0;
        }

        .total {
            font-weight: bold;
            font-size: 14px;
            border-top: 1px solid #333;
            margin-top: 5px;
            padding-top: 5px;
        }

        .footer {
            margin-top: 50px;
            text-align: left;
            font-size: 11px;
            color: #777;
        }

        .payment-info {
            margin-top: 20px;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 4px;
        }

        .payment-info h3 {
            margin: 0 0 5px 0;
            font-size: 14px;
            color: #2c3e50;
        }

        .payment-status {
            padding: 3px 8px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 11px;
        }

        .paid {
            background-color: #d4edda;
            color: #155724;
        }

        .pending {
            background-color: #fff3cd;
            color: #856404;
        }

        /* Only added this one new style for delivery info */
        .delivery-line {
            margin: 10px 0;
            padding: 8px;
            background: #f0f8ff;
            /*font-weight: bold;*/
        }
        .arabic-text {
            font-family: 'DejaVu Sans', sans-serif;
            direction: rtl;
        }
    </style>
</head>
<body>
<div class="invoice-container">

    <!-- Header with invoice info and logo aligned -->
    <table class="header-table">
        <tr>
            <td valign="top">
                <div class="invoice-info">
                    <h2>INVOICE</h2>
                    <p><strong>Order #:</strong> {{ $order->id }}</p>
                    <p><strong>Date:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
                    <p><strong>Name:</strong> {{ $order->customer->name }}</p>
                    <p><strong>Phone #:</strong> {{ $order->customer->phone_number }}</p>
                </div>
            </td>
            <td valign="top" style="text-align: right;">
                <img src="file://{{ public_path('assets/images/logo/happyhome-logo.png') }}" class="logo" alt="Company Logo">
                <br><br>
                <p style="margin-top: 27px"><strong>Vat Registration #:</strong> 310334250300003</p>
            </td>
        </tr>
    </table>

    <!-- Delivery information in single line -->
    <div class="delivery-line">
        <strong>Delivery Day:</strong>
        {{ $order->deliveryDay->name_en ?? '' }} |
        <strong>Delivery Time:</strong>
        {{ $order->deliveryTime->time_slot ?? '' }}

        <p><strong>Address:</strong> <span dir="rtl" style="text-align:right; font-family: 'DejaVu Sans', sans-serif;">
                    {{ $order->deliveryAddress->address }}
            </span></p>
        <!--<p><strong>Address:</strong> {{ $order->deliveryAddress->address }}</p>-->
    </div>

    <!-- Items Table -->
    <table>
        <thead>
        <tr>
            <th>S.No</th>
            <th>Product</th>
            <th></th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @php
            $subtotal = 0;
            $count = 0;
        @endphp
        @foreach($order->orderItems as $item)
            <tr>
                <td>
                    {{ ++$count }}
                </td>
                <td>
                    @php
                        $subtotal += $item->quantity * $item->price;
                        $image = optional($item->productDetail->productVariant->product->productImages->first())->file_name;
                        $imagePath = $image
                            ? public_path('storage/products/' . $image)
                            : public_path('storage/products/default.png');
                    @endphp

                    @if(file_exists($imagePath))
                        <img src="file://{{ $imagePath }}" class="item-image" alt="Product Image">
                    @else
                        <div>No Image</div>
                    @endif
                </td>
                <td>
                    {{ $item->productDetail->productVariant->product->name_en }}<br>
                    <small> {{ $item->productDetail->productVariant->weight }} {{ $item->productDetail->productVariant->unit->name }}</small> -
                    <small>{{ $item->productDetail->productPacking->packaging_level }}</small>
                </td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 2) }}</td>
                <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Rest of your existing content remains exactly the same -->
    <!-- Totals Section -->
    <div class="totals">
        <div class="totals-row">
            <span>Subtotal:</span>
            <span>{{ number_format($subtotal, 2) }}</span>
        </div>

        <div class="totals-row">
            <span>Tax:</span>
            <span>{{ number_format($order->total_tax, 2) }}</span>
        </div>
        <div class="totals-row">
            <span>Shipping:</span>
            <span>{{ number_format($order->delivery_cost, 2) }}</span>
        </div>
        <div class="totals-row">
            <span>Discount:</span>
            <span>{{ number_format($order->total_discount, 2) }}</span>
        </div>
        <div class="totals-row">
            <span>Wallet Points:</span>
            <span>{{ number_format($order->wallet_points, 2) }}</span>
        </div>
        @if($order->wallet_points_refund > 0)
            <div class="totals-row">
                <span>Wallet Refund:</span>
                <span>{{ number_format($order->wallet_points_refund, 2) }}</span>
            </div>
        @endif
        <div class="totals-row total">
            <span>Total:</span>
            <span>{{ number_format($order->total_amount, 2) }}</span>
        </div>
    </div>

    <!-- Payment Information -->
    <div class="payment-info">
        <h3>Payment Details</h3>
        <p><strong>Method:</strong> {{ $order->paymentMethod->name_en }}</p>
        <p><strong>Status:</strong>
            <span class="payment-status {{ $order->payment_status ? 'paid' : 'pending' }}">
                {{ $order->payment_status ? 'Paid' : 'Pending' }}
            </span>
        </p>
        <p><strong>Pay on Delivery:</strong> {{ $order->total_amount_unpaid }}</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Thank you for shopping with Happy Home Sweets!</p>
        <p>For any inquiries, please contact: +966500989088</p>
    </div>
</div>
</body>
</html>
