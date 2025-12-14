<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $page = 'orders';
        
        return view("admin.index", compact('page'));
    }

    public function show($id)
    {
        $order = Order::with('items.product', 'user')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $validated = $request->validate([
            'status' => ['required', 'in:pending,confirmed,shipped,delivered,cancelled'],
        ]);
        
        $order->update(['status' => $validated['status']]);
        
        return back()->with('success', 'Status porudžbine je ažuriran na: ' . $this->getStatusLabel($validated['status']));
    }

    public function confirmOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'confirmed']);
        
        return back()->with('success', 'Porudžbina #' . $order->id . ' je potvrđena!');
    }

    private function getStatusLabel($status)
    {
        $labels = [
            'pending' => 'Čeka potvrdu',
            'confirmed' => 'Potvrđena',
            'shipped' => 'Poslata',
            'delivered' => 'Dostavljena',
            'cancelled' => 'Otkazana',
        ];
        return $labels[$status] ?? $status;
    }
}
