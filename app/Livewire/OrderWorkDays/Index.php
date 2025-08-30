<?php

namespace App\Livewire\OrderWorkDays;

use App\Models\OrderWorkDay;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    #[Layout('layouts.app')]
    public function render(): View
    {
        $orderWorkDays = OrderWorkDay::search($this->search)->paginate();

        return view('livewire.order-work-day.index', compact('orderWorkDays'))
            ->with('i', $this->getPage() * $orderWorkDays->perPage());
    }

    public function searchDeliveryTimes($term)
    {
        $this->search = $term;
    }

    public function delete(OrderWorkDay $orderWorkDay)
    {
        $orderWorkDay->delete();

        return $this->redirectRoute('order-work-days.index', navigate: true);
    }
}
