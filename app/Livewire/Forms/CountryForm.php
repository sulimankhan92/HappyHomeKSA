<?php

namespace App\Livewire\Forms;

use App\Models\Country;
use Livewire\Form;

class CountryForm extends Form
{
    public ?Country $countryModel;
    
    public $name_en = '';
    public $name_ar = '';
    public $iso_code = '';
    public $phone_code = '';
    public $currency = '';

    public function rules(): array
    {
        return [
			'name_en' => 'required|string',
			'name_ar' => 'required|string',
			'iso_code' => 'string',
			'phone_code' => 'string',
			'currency' => 'string',
        ];
    }

    public function setCountryModel(Country $countryModel): void
    {
        $this->countryModel = $countryModel;
        
        $this->name_en = $this->countryModel->name_en;
        $this->name_ar = $this->countryModel->name_ar;
        $this->iso_code = $this->countryModel->iso_code;
        $this->phone_code = $this->countryModel->phone_code;
        $this->currency = $this->countryModel->currency;
    }

    public function store(): void
    {
        $this->countryModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->countryModel->update($this->validate());

        $this->reset();
    }
}
