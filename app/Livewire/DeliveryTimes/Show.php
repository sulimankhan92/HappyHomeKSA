<?php

namespace App\Livewire\DeliveryTimes;

use App\Livewire\Forms\DeliveryTimeForm;
use App\Models\DeliveryTime;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public DeliveryTimeForm $form;

    public function mount(DeliveryTime $deliveryTime)
    {
        $this->form->setDeliveryTimeModel($deliveryTime);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.delivery-time.show', ['deliveryTime' => $this->form->deliveryTimeModel]);
    }
}
