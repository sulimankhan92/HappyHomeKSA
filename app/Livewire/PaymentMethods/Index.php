<?php

namespace App\Livewire\PaymentMethods;

use App\Models\PaymentMethod;
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
        $paymentMethods = PaymentMethod::search($this->search)->paginate();

        return view('livewire.payment-method.index', compact('paymentMethods'))
            ->with('i', $this->getPage() * $paymentMethods->perPage());
    }

    public function searchPaymentMethods($term)
    {
        $this->search = $term;
    }

    public function delete(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

        return $this->redirectRoute('payment-methods.index', navigate: true);
    }
}
