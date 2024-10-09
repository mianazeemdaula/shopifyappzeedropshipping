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
                if($this->user->stores()->count() > 0){
                    $this->user->stores()->delete();
                }
                $this->user->stores()->create([
                    'user_id' => $this->user->id,
                    'name' => $this->user->name,
                    'api_key' => $response->token,
                    'zeedropshipping_uid' => $response->user->id,
                    'userdata' => json_encode($response->user),
                ]);
                $this->dispatch('refreshpage');
                // dd(request()->all());
                // return Redirect::tokenRedirect('home');
                // return redirect()->tokenRedirect('home', ['host' => request()->input('host')]);
            }else{
                return redirect()->back()->with('error', $response->message);
            }
        } catch (\Throwable $th) {
            if($this->parseRes($th->getMessage())){
                return redirect()->back()->with('error', $this->parseRes($th->getMessage()));
            }
            return redirect()->back()->with('error', $th->getMessage());
        }finally{
            $loading = false;
        }
    }

    private function parseRes($string){
        $matches = array();
        preg_match('/\{.*\}/', $string, $matches);
        if (isset($matches[0])) {
            $jsonString = $matches[0];
            $responseData = json_decode($jsonString, true);
            // Check if the "message" key exists and get its value
            if (isset($responseData['message'])) {
                return $responseData['message'];
            }
        }
        return null;
    }
}
