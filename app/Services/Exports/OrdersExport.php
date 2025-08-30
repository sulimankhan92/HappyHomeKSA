<?php

namespace App\Services\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray; // Add this line

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $orderIds;

    public function __construct(array $orderIds)
    {
        $this->orderIds = $orderIds;
    }

    public function collection()
    {
        return Order::whereIn('id', $this->orderIds)->with('couponUsers')->get();
    }

    public function headings(): array
    {
        return [
            'Order Number',
            'Order Status',
            'Delivery Captain',
            'Order Date',
            'Customer Name',
            'Phone (Billing)',
            'Payment Method',
            'Order Subtotal Amount',
            'Order Shipping Amount',
            'Wallet Pointst',
            'Order Refund Amount',
            'Order Total Amount',
            'Order Total Tax Amount',
            'Coupon Code',
            'Subtotal Discount Amount',
            'Tax Discount Amount',
            'Total Discount Amount',
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->getStatusOptions()[$order->status] ?? '',
            optional($order->deliveryCaptain)->name,
            $order->created_at->format('Y-m-d'),
            optional($order->customer)->name ?? '',
            optional($order)->customer->phone_number ?? '',
            optional($order->paymentMethod)->name_en ?? '',
            $order->total_amount - ($order->delivery_cost + $order->total_tax),
            $order->delivery_cost ?? '',
            $order->wallet_points ?? '',
            $order->wallet_points_refund ?? '',
            $order->total_amount ?? '',
            $order->total_tax ?? '',
            $order->coupon->code ?? '',
            $order->total_discount  * 0.87 ?? '',
            $order->total_discount * 0.13 ?? '',
            $order->total_discount,
        ];
    }
}
