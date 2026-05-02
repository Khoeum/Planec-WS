<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderNotification;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = Order::create($request->all());

        Mail::to('seller@email.com')->send(new OrderNotification($order));

        return response()->json([
            'message' => 'Order submitted and email sent successfully',
            'data' => $order
        ]);
    }
}