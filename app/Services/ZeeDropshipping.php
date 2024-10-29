<?php

namespace App\Services;

class ZeeDropshipping{
    
    private $http;
    public function __construct()
    {
        $this->http = new \GuzzleHttp\Client([
            'base_uri' => 'https://zeedropshipping.com/api/',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    public function login($email, $password)
    {
        $response = $this->http->post('login', [
            'json' => [
                'email' => $email,
                'password' => $password
            ]
        ]);
        $data = json_decode($response->getBody()->getContents());
        if($response->getStatusCode() == 200){
            return $data;
        }else{
            throw new \Exception($data->message);
        }
    }

    public function exportOrders($params)
    {
        $response = $this->http->post('shopify/orders', [
            'json' => $params
        ]);
        $data = json_decode($response->getBody()->getContents());
        if($response->getStatusCode() == 200 || $response->getStatusCode() == 201){
            return $data;
        }else{
            throw new \Exception($data->message);
        }
    }
    

    public function dashboard(){
        try {
            $auth = auth()->user()->stores()->first();
            $response = $this->http->get('dashboard', [
                'headers' => [
                    'Authorization' => 'Bearer '.$auth->api_key
                ],
            ]);
            $data = json_decode($response->getBody()->getContents());
            if($response->getStatusCode() == 200){
                return $data;
            }else{
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }
}