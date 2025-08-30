<?php

namespace App\Livewire\Countries;

use App\Livewire\Forms\CountryForm;
use App\Models\Country;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public CountryForm $form;

    public function mount(Country $country)
    {
        $this->form->setCountryModel($country);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.country.show', ['country' => $this->form->countryModel]);
    }
}
