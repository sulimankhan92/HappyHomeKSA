<?php

namespace App\Livewire\PaymentMethods;

use App\Livewire\Forms\PaymentMethodForm;
use App\Models\PaymentMethod;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public PaymentMethodForm $form;

    public function mount(PaymentMethod $paymentMethod)
    {
        $this->form->setPaymentMethodModel($paymentMethod);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('payment-methods.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.payment-method.edit');
    }
}
