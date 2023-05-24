<!-- cart.blade.php -->

<!-- Display the cart items -->
@if(count($cartItems) > 0)
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price * $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Checkout button -->
    <form action="{{ route('cart.checkout') }}" method="POST">
        @csrf
        <button type="submit">Checkout</button>
    </form>
@else
    <p>No items in the cart.</p>
@endif
