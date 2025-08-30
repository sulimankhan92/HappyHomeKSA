<?php
namespace App\Services\Exports;

use App\Models\SaleItem;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Exports\SaleItemExport;

class SaleItemExportService
{
    /**
     * Export sale items based on filters.
     *
     * @param array $filters
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(array $filters)
    {
        $query = SaleItem::with(['user', 'productVariant.product'])->latest();

        if (!empty($filters['from_date'])) {
            $query->whereDate('created_at', '>=', Carbon::parse($filters['from_date']));
        }

        if (!empty($filters['to_date'])) {
            $query->whereDate('created_at', '<=', Carbon::parse($filters['to_date']));
        }

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->whereHas('user', fn($u) =>
                $u->where('name', 'like', '%' . $filters['search'] . '%')
                )->orWhereHas('productVariant.product', fn($p) =>
                $p->where('name_en', 'like', '%' . $filters['search'] . '%')
                )->orWhere('order_id', 'like', '%' . $filters['search'] . '%');
            });
        }

        $items = $query->get();
        $fileName = 'sale_items_' . now()->format('Y-m-d_H-i-s') . '.csv';

        return Excel::download(new SaleItemExport($items), $fileName);
    }
}
