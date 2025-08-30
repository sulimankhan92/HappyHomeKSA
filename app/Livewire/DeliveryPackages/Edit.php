<?php

namespace App\Livewire\DeliveryPackages;

use App\Livewire\Forms\DeliveryPackageForm;
use App\Models\DeliveryPackage;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public DeliveryPackageForm $form;

    public function mount(DeliveryPackage $deliveryPackage)
    {
        $this->form->setDeliveryPackageModel($deliveryPackage);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('delivery-packages.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.delivery-package.edit');
    }
}
