<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserStore;
class ExportOrders extends Component
{

    public $selected = [];
    public $user;
    public $orders;
    public $ordersSent = false;

    public function mount($orders)
    {
        $this->orders = $orders;
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.export-orders');
    }

    public function toggleSelect($id)
    {
        if (in_array($id, $this->selected)) {
            $this->selected = array_diff($this->selected, [$id]);
        } else {
            $this->selected[] = $id;
        }
    }

    public function toggleSelectAll()
    {
        if (count($this->selected) == count($this->orders)) {
            $this->selected = [];
        } else {
            $this->selected = array_map(function ($order) {
                return $order['id'];
            }, $this->orders);
        }
    }

    public function exportToZeedropshipping()
    {
        try {
            $zee = new \App\Services\ZeeDropshipping();
            $store = UserStore::where('name', $this->user->name)->first();
            // get selected orders with manually keys
            $selectedOrders = array_filter($this->orders, function ($order) {
                return in_array($order['id'], $this->selected);
            });
            $zeeorders = [];
            foreach ($selectedOrders as $order) {
                $zeeorders[] = [
                    'id' => $order['id'],
                    'customer_name' => $order['customer']['first_name']. " " . $order['customer']['last_name'],
                    'customer_phone' => $order['customer']['phone'],
                    'customer_email' => $order['customer']['email'],
                    'shipping_address' => $order['shipping_address']['address1'],
                    'billing_address' => $order['billing_address']['address1'] ?? $order['shipping_address']['address1'],
                    'zip' => $order['shipping_address']['zip'],
                    'city' => $order['shipping_address']['city'],
                    'total' => $order['total_price'],
                    'tax' => 0,
                    'extra_note' => $order['note'],
                    'order_date' => $order['created_at'],
                    'details' => array_map(function ($item) {
                        return [
                            'quantity' => $item['current_quantity'],
                            'price' => $item['price'],
                            'sku' => $item['sku'],
                        ];
                    }, $order['line_items'])
                ];
            }
            // dd([
            //     $zeeorders,
            //     $store->zeedropshipping_uid,
            // ]);
            $zee->exportOrders([
                'orders' => $zeeorders,
                'user_id' => $store->zeedropshipping_uid
            ]);
            $this->ordersSent = true;
            // clear selected orders
            $this->selected = [];
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
        /**
         * total_price: "457924702",
         * email: "",
         * name: "#1002",
         * note: "",
         * shipping_address: {
         * first_name: "John",
         * last_name: "Smith",
         * zip: "K1M 1M4",
         * address1: "123 Main St",
         * 'city': 'Ottawa',
         * 'phone': '555-555-5555',}
         * customer: {
         * first_name: "John",
         * last_name: "Smith",
         * phone: "555-555-5555",
         * email: "",
         * }
         * line_items: [
         *     {
         *        id: 395331779,
         *       current_quantity: 1,
         *      price: 457924702,
         *    sku: 632910392,
         * }
         * ]
         */
    }
}
