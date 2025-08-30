<?php

namespace App\Livewire\Countries;

use App\Models\Country;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    public function render(): View
    {
        $countries = Country::paginate();

        return view('livewire.country.index', compact('countries'))
            ->with('i', $this->getPage() * $countries->perPage());
    }

    public function delete(Country $country)
    {
        $country->delete();

        return $this->redirectRoute('countries.index', navigate: true);
    }
}
