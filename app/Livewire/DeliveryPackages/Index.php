<?php

namespace App\Livewire\DeliveryPackages;

use App\Models\DeliveryPackage;
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
        $deliveryPackages = DeliveryPackage::search($this->search)->paginate();

        return view('livewire.delivery-package.index', compact('deliveryPackages'))
            ->with('i', $this->getPage() * $deliveryPackages->perPage());
    }

    public function searchDeliveryPackages($term)
    {
        $this->search = $term;
    }

    public function delete(DeliveryPackage $deliveryPackage)
    {
        $deliveryPackage->delete();

        return $this->redirectRoute('delivery-packages.index', navigate: true);
    }
}
