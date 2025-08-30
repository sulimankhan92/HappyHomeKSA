<?php

namespace App\Livewire\SaleItems;

use App\Models\SaleItem;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\Exports\SaleItemExportService;
class Index extends Component
{
    use WithPagination;

    public $fromDate = null;
    public $toDate = null;
    public $search = '';
    public $filtersApplied = false;

    public $filterFromDate;
    public $filterToDate;
    public $filterSearch;

    #[Layout('layouts.app')]
    public function render(): View
    {
        $query = SaleItem::query()
            ->with(['user', 'productVariant.product'])
            ->latest();

        if ($this->filterFromDate) {
            $query->whereDate('created_at', '>=', Carbon::parse($this->filterFromDate));
        }

        if ($this->filterToDate) {
            $query->whereDate('created_at', '<=', Carbon::parse($this->filterToDate));
        }

        if ($this->filterSearch) {
            $query->where(function ($q) {
                $q->whereHas('user', function ($userQuery) {
                    $userQuery->where('name', 'like', '%' . $this->filterSearch . '%');
                })
                    ->orWhereHas('productVariant.product', function ($productQuery) {
                        $productQuery->where('name_en', 'like', '%' . $this->filterSearch . '%');
                    })
                    ->orWhere('order_id', 'like', '%' . $this->filterSearch . '%');
            });
        }

        $this->filtersApplied = $this->filterFromDate || $this->filterToDate || $this->filterSearch;

        $saleItems = $query->paginate(20);

        return view('livewire.sale-item.index', [
            'saleItems' => $saleItems,
            'i' => ($this->getPage() - 1) * $saleItems->perPage(),
        ]);
    }

    public function applyFilters()
    {
        $this->filterFromDate = $this->fromDate;
        $this->filterToDate = $this->toDate;
        $this->filterSearch = $this->search;

        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->fromDate = null;
        $this->toDate = null;
        $this->search = '';
        $this->filterFromDate = null;
        $this->filterToDate = null;
        $this->filterSearch = null;
        $this->filtersApplied = false;

        $this->resetPage();
    }

    public function exportCSV()
    {
        $filters = [
            'from_date' => $this->fromDate,
            'to_date'   => $this->toDate,
            'search'    => $this->search,
        ];

        return app(SaleItemExportService::class)->export($filters);
    }
}
