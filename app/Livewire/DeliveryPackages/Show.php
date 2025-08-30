<?php

namespace App\Livewire\DeliveryPackages;

use App\Livewire\Forms\DeliveryPackageForm;
use App\Models\DeliveryPackage;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public DeliveryPackageForm $form;

    public function mount(DeliveryPackage $deliveryPackage)
    {
        $this->form->setDeliveryPackageModel($deliveryPackage);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.delivery-package.show', ['deliveryPackage' => $this->form->deliveryPackageModel]);
    }
}
