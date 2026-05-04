<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderReceived;

class OrderController extends Controller
{
    /**
     * POST /api/orders
     * Called by Vue Shop when customer clicks "Confirm Order"
     */
    public function store(Request $request): JsonResponse
    {
        // ── 1. Validate ────────────────────────────────────────────
        $validated = $request->validate([
            'firstName'        => 'required|string|max:100',
            'lastName'         => 'required|string|max:100',
            'phone'            => 'required|string|max:50',
            'telegram'         => 'required|string|max:100',
            'email'            => 'nullable|email|max:150',
            'location'         => 'required|string|max:500',
            'notes'            => 'nullable|string|max:1000',
            'items'            => 'required|array|min:1',
            'items.*.name'     => 'required|string|max:200',
            'items.*.category' => 'nullable|string|max:100',
            'items.*.qty'      => 'required|integer|min:1',
            'items.*.price'    => 'required|numeric|min:0',
            'total'            => 'required|string',
        ]);

        // ── 2. Generate Order ID & Date ────────────────────────────
        $orderId   = 'PLC-' . strtoupper(substr(uniqid(), -6));
        $orderDate = now()->format('F d, Y h:i A');

        // ── 3. Merge everything ────────────────────────────────────
        $orderData = array_merge($validated, [
            'orderId'   => $orderId,
            'orderDate' => $orderDate,
        ]);

        // ── 4. Send email to seller ────────────────────────────────
        try {
            $sellerEmail = env('SELLER_EMAIL', 'cpnkhoeumvd030005@gmail.com');

            Mail::to($sellerEmail)->send(new OrderReceived($orderData));

            Log::info('✅ Order email sent', ['orderId' => $orderId]);

        } catch (\Exception $e) {
            // Don't fail the order if email fails — just log it
            Log::error('❌ Order email failed', [
                'orderId' => $orderId,
                'error'   => $e->getMessage(),
            ]);
        }

        // ── 5. Return response to Vue ──────────────────────────────
        return response()->json([
            'success'   => true,
            'orderId'   => $orderId,
            'orderDate' => $orderDate,
            'message'   => 'Order placed successfully!',
        ], 201);
    }
}