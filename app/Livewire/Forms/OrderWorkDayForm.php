<?php

namespace App\Livewire\Forms;

use App\Models\OrderWorkDay;
use Livewire\Form;

class OrderWorkDayForm extends Form
{
    public ?OrderWorkDay $orderWorkDayModel;
    
    public $day = '';
    public $is_work_day = '';

    public function rules(): array
    {
        return [
			'day' => 'required',
			'is_work_day' => 'required',
        ];
    }

    public function setOrderWorkDayModel(OrderWorkDay $orderWorkDayModel): void
    {
        $this->orderWorkDayModel = $orderWorkDayModel;
        
        $this->day = $this->orderWorkDayModel->day;
        $this->is_work_day = $this->orderWorkDayModel->is_work_day;
    }

    public function store(): void
    {
        $this->orderWorkDayModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->orderWorkDayModel->update($this->validate());

        $this->reset();
    }
}
