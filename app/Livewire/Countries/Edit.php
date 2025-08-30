<?php

namespace App\Livewire\Countries;

use App\Livewire\Forms\CountryForm;
use App\Models\Country;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{
    public CountryForm $form;

    public function mount(Country $country)
    {
        $this->form->setCountryModel($country);
    }

    public function save()
    {
        $this->form->update();

        return $this->redirectRoute('countries.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.country.edit');
    }
}
