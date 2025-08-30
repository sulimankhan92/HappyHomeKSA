<?php

namespace App\Livewire\OrderWorkDays;

use App\Livewire\Forms\OrderWorkDayForm;
use App\Models\OrderWorkDay;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public OrderWorkDayForm $form;

    public function mount(OrderWorkDay $orderWorkDay)
    {
        $this->form->setOrderWorkDayModel($orderWorkDay);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('order-work-days.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.order-work-day.edit');
    }
}
