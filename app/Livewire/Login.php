<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Redirect;
class Login extends Component
{
    public $email;
    public $password;

    public $user;

    public $loading = false;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.login');
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $loading = true;
        $zee = new \App\Services\ZeeDropshipping();
        try {
            $response = $zee->login($this->email, $this->password);
            if($response && $response->user){
                $this->user->stores()->create([
                    'user_id' => $this->user->id,
                    'name' => $this->user->name,
                    'api_key' => $response->token,
                    'zeedropshipping_uid' => $response->user->id,
                ]);
                return Redirect::tokenRedirect('home');
            }else{
                return redirect()->back()->with('error', $response->message);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }finally{
            $loading = false;
        }
    }
}
