<?php

namespace App\Livewire\PaymentMethods;

use App\Livewire\Forms\PaymentMethodForm;
use App\Models\PaymentMethod;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public PaymentMethodForm $form;

    public function mount(PaymentMethod $paymentMethod)
    {
        $this->form->setPaymentMethodModel($paymentMethod);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.payment-method.show', ['paymentMethod' => $this->form->paymentMethodModel]);
    }
}
