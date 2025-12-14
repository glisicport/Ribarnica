<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $quantity = $request->input('quantity', 1); // default 1 kg

        // Check if product has enough stock
        if ($product->stock < $quantity) {
            return redirect()->back()->withErrors(['error' => "Nedovoljno zalihe! Dostupno je samo {$product->stock} kg."]);
        }

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id()
        ]);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($item) {
            // Check if adding quantity would exceed stock
            $totalQuantity = $item->quantity + $quantity;
            if ($product->stock < $totalQuantity) {
                return redirect()->back()->withErrors(['error' => "Nedovoljno zalihe! Dostupno je samo {$product->stock} kg."]);
            }
            $item->quantity += $quantity;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
        }

        return redirect()->back()->with('success', 'Proizvod je dodat u korpu.');
    }

    public function view()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->first();

        return view('cart.index', compact('cart'));
    }

    public function remove($itemId)
    {
        CartItem::where('id', $itemId)
            ->whereHas('cart', fn($cart) => $cart->where('user_id', Auth::id()))
            ->delete();

        return redirect()->route('cart.view');
    }

    public function updateQuantity(Request $request, $itemId)
    {
        $item = CartItem::where('id', $itemId)
            ->whereHas('cart', fn($cart) => $cart->where('user_id', Auth::id()))
            ->first();

        if (!$item) {
            return redirect()->route('cart.view')->withErrors(['error' => 'Stavka nije pronađena.']);
        }

        $action = $request->input('action');
        $quantity = $request->input('quantity', $item->quantity);
        $newQuantity = $item->quantity;

        if ($action === 'decrease') {
            $newQuantity = max(1, $item->quantity - 1);
        } elseif ($action === 'increase') {
            $newQuantity = $item->quantity + 1;
        } else {
            $newQuantity = max(1, (int)$quantity);
        }

        // Check if product has enough stock for new quantity
        $product = $item->product;
        if ($product->stock < $newQuantity) {
            return redirect()->route('cart.view')->withErrors(['error' => "Nedovoljno zalihe! Dostupno je samo {$product->stock} kg."]);
        }

        $item->quantity = $newQuantity;
        $item->save();

        return redirect()->route('cart.view')->with('success', 'Količina je ažurirana.');
    }

    public function checkout(Request $request)
    {
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('cart.view')->withErrors(['error' => 'Korpa je prazna.']);
        }

        // Validate checkout form
        $validated = $request->validate([
            'ime' => ['required', 'string', 'max:255'],
            'prezime' => ['required', 'string', 'max:255'],
            'adresa' => ['required', 'string', 'max:255'],
            'ppt' => ['required', 'string', 'max:10'],
            'contact' => ['required', 'string', 'max:255'],
        ], [
            'ime.required' => 'Polje Ime je obavezno.',
            'prezime.required' => 'Polje Prezime je obavezno.',
            'adresa.required' => 'Polje Adresa je obavezno.',
            'ppt.required' => 'Polje Poštanski broj je obavezno.',
            'contact.required' => 'Polje Telefon ili Email je obavezno.',
        ]);

        // Validate stock availability for all items before checkout
        foreach ($cart->items as $item) {
            if ($item->product->stock < $item->quantity) {
                return redirect()->route('cart.view')->withErrors(['error' => "Proizvod '{$item->product->name}' ima nedovoljno zalihe! Dostupno je samo {$item->product->stock} kg."]);
            }
        }

        // Calculate total
        $totalAmount = $cart->items->sum(fn($item) => $item->quantity * $item->price);

        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'first_name' => $validated['ime'],
            'last_name' => $validated['prezime'],
            'address' => $validated['adresa'],
            'postal_code' => $validated['ppt'],
            'phone_or_email' => $validated['contact'],
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        // Create order items and deduct from stock
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);

            // Deduct quantity from product stock
            $item->product->decrement('stock', $item->quantity);
        }

        // Clear the cart
        CartItem::whereIn('id', $cart->items->pluck('id'))->delete();

        return redirect()->route('order.success', $order->id)
            ->with('success', 'Porudžbina je uspešno kreirana!');
    }

    public function orderSuccess($orderId)
    {
        $order = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->find($orderId);

        if (!$order) {
            return redirect()->route('korisnicki-nalog')->withErrors(['error' => 'Porudžbina nije pronađena.']);
        }

        return view('cart.order-success', compact('order'));
    }

    public function orderHistory()
    {
        // Get last 30 orders for the authenticated user
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(30)
            ->get();

        return view('cart.order-history', compact('orders'));
    }

    public function orderDetail($orderId)
    {
        $order = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->find($orderId);

        if (!$order) {
            return redirect()->route('order.history')->withErrors(['error' => 'Porudžbina nije pronađena.']);
        }

        return view('cart.order-detail', compact('order'));
    }
}
