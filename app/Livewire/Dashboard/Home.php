<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Redirect;
class Home extends Component
{
    public $data;
    public $user;

    public function mount($data)
    {
        $this->data = $data;
        $this->user = auth()->user();
    }
    public function render()
    {
        return view('livewire.dashboard.home');
    }

    public function logout(){
        // remove all stores
        $this->user->stores()->delete();
        $this->dispatch('refreshpage');
        // return Redirect::tokenRedirect('home');
    }
}
