<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $user;
    public $loading = false;
    public $tab = 'home';

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
