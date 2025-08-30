<?php
namespace App\Livewire\HappyHome;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.HappyHome.home')
            ->layout('layouts.happy_app', ['title' => 'Home']);
    }
}
