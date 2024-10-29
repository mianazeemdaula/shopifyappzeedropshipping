<div class="w-full">
    <div class="rounded-lg shadow-md p-4 bg-white ">
        @if ($ordersSent)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">Orders have been sent to Zeedropshipping</span>
            </div>
        @endif

        @if ($errorMessage)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $errorMessage }}</span>
            </div>
        @endif
        <div class="my-2">
            <h1 class="text-lg font-bold">Export Orders</h1>
            <div class="text-red-500">
                This page allows you to export orders to Zeedropshipping. Orders that have been exported will be
                automatically fulfilled by Zeedropshipping. Only orders that have complete required information will
                show here.
            </div>
            <div class="text-xs">
                Select the orders you want to export to Zeedropshipping. Once you have selected the orders, click the
                export button.
            </div>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <td scope="col" class="px-1 py-2 font-normal text-gray-700">
                        <input type="checkbox" wire:click="toggleSelectAll">
                    </td>
                    <td scope="col" class="px-2 py-2 text-left font-normal text-gray-700">Order ID</td>
                    <td scope="col" class="px-2 py-2 text-left font-normal text-gray-700">Order Date</td>
                    {{-- <td scope="col" class="px-2 py-2 text-left font-normal text-gray-700">Customer Name</td> --}}
                    <td scope="col" class="px-2 py-2 text-left font-normal text-gray-700">City</td>
                    <td scope="col" class="px-2 py-2 text-left font-normal text-gray-700"># Products</td>
                    <td scope="col" class="px-2 py-2 text-left font-normal text-gray-700">Total</td>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @foreach ($orders as $order)
                    <tr>
                        <td>
                            <input type="checkbox" value="{{ $order['id'] }}" wire:model.defer="selected">
                        </td>
                        <td class="whitespace-nowrap px-1 py-4 text-sm">{{ $order['id'] }}</td>
                        <td class="whitespace-nowrap px-1 py-4 text-sm">{{ Carbon\Carbon::parse($order['created_at']) }}
                        </td>
                        {{-- <td class="whitespace-nowrap px-1 py-4 text-sm">{{ $order['customer']['first_name'] }}
                            {{ $order['customer']['last_name'] }}</td> --}}
                        <td class="whitespace-nowrap px-1 py-4 text-sm">
                            {{ $order['shipping_address']['city'] ?? 'N/A' }}</td>
                        <td class="whitespace-nowrap px-1 py-4 text-sm">{{ count($order['line_items']) }}</td>
                        <td class="whitespace-nowrap px-1 py-4 text-sm">{{ $order['total_price'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if (!$ordersSent)
        <div class="flex items-end justify-end mt-4">
            <button class="px-4 py-2 rounded-lg bg-black text-white hover:bg-gray-900 inline-block"
                wire:click="exportToZeedropshipping">Export</button>
        </div>
    @endif
</div>
