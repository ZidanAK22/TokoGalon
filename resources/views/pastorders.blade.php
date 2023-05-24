<x-app-layout>
    <div class="container px-12 py-8 mx-auto">
        <h3 class="text-2xl font-bold text-gray-900">Riwayat Pembelian</h3>
        <div class="h-1 bg-gray-800 w-48"></div>
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($orders as $order)
            <div class="w-full max-w-sm mx-auto overflow-hidden bg-white rounded-md shadow-md">
                @foreach ($order->products as $product)
                <img src="{{ url($product->image) }}" alt="" class="w-full max-h-60">
                <div class="px-5 py-3">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-gray-700 uppercase">Order ID: {{ $order->id }}</h3>
                        <span class="mt-2 text-gray-500 font-semibold">Total Price: ${{ $order->total_price }}</span>
                    </div>
                    <ul>
                        <li>
                            <div class="flex items-center">
                                <img src="{{ url($product->image) }}" alt="" class="w-8 h-8 mr-2">
                                <span>{{ $product->name }} (Quantity: {{ $product->pivot->quantity }})</span>
                            </div>
                        </li>
                    </ul>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
