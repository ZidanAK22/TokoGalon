<!-- resources/views/checkout/debug.blade.php -->

<h1>Debug Information</h1>

@if (isset($error))
    <p>Error: {{ $error }}</p>
@endif

@if (isset($exception))
    <pre>{{ $exception }}</pre>
@endif

<h2>User</h2>
<pre>{{ $user }}</pre>

<h2>Cart Items</h2>
<pre>{{ $cartItems }}</pre>

<h2>Total Price</h2>
<p>{{ $totalPrice }}</p>

<h2>Order</h2>
<pre>{{ $order }}</pre>
