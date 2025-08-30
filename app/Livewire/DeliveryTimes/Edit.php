<?php

namespace App\Livewire\DeliveryTimes;

use App\Livewire\Forms\DeliveryTimeForm;
use App\Models\DeliveryTime;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public DeliveryTimeForm $form;

    public function mount(DeliveryTime $deliveryTime)
    {
        $this->form->setDeliveryTimeModel($deliveryTime);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('delivery-times.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.delivery-time.edit');
    }
}
