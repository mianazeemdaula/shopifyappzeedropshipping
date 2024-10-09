<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $user;
    public $loading = false;
    public $tab = 'home';
    public $data = [];

    public function mount($data)
    {
        $this->user = auth()->user();
        $this->data = $data;
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
