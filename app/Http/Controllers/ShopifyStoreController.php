<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShopifyStoreController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if($user && $user->stores()->count() == 0){
            return view('login');
        }
        $zee = new \App\Services\ZeeDropshipping();
        $data = $zee->dashboard();
        return view('welcome', compact('data'));
    }

    public function exportorders(Request $request)
    {
        $shop = auth()->user();
        $ids = is_array($request->ids) ?  implode(',',$request->ids) : [$request->ids];
        $data =  $shop->api()->rest('GET', '/admin/api/2024-07/orders.json', ['ids' => $ids,'status' => 'any']);
        if(isset($data['status']) &&  $data['status'] == 200){
            $orders =  $data['body']['orders'];
            $orders = json_encode($orders);
            $orders = json_decode($orders, true);
            return view('export-orders', compact('orders'));
        }
        return "Error";
    }
}
