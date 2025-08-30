<?php
namespace App\Services\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SaleItemExport implements FromCollection, WithHeadings
{
    protected $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function collection()
    {
        return $this->items->map(function ($item) {
            return [
                'No'               => $item->id,
                'Customer'         => $item->user->name ?? '',
                'Order ID'         => $item->order_id,
                'Product'          => $item->productVariant->product->name_en ?? '',
                'Quantity'         => $item->quantity,
                'Purchase Price'   => $item->purchase_price,
                'Sale Price'       => $item->unit_price,
                'Profit Per Item'  => $item->profit_per_item,
                'Total Profit'     => $item->profit,
                'Expiry Date'      => $item->expiry_date,
                'Created At'       => $item->created_at->toDateTimeString(),
            ];
        });
    }


    public function headings(): array
    {
        return [
            'No',
            'Customer',
            'Order ID',
            'Product',
            'Quantity',
            'Purchase Price',
            'Sale Price',
            'Profit Per Item',
            'Total Profit',
            'Expiry Date',
            'Created at',
        ];
    }

}

