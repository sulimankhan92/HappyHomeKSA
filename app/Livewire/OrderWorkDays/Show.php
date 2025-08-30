<?php

namespace App\Livewire\OrderWorkDays;

use App\Livewire\Forms\OrderWorkDayForm;
use App\Models\OrderWorkDay;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public OrderWorkDayForm $form;

    public function mount(OrderWorkDay $orderWorkDay)
    {
        $this->form->setOrderWorkDayModel($orderWorkDay);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.order-work-day.show', ['orderWorkDay' => $this->form->orderWorkDayModel]);
    }
}
