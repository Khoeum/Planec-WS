<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // ─────────────────────────────
        // VALIDATION
        // ─────────────────────────────
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
            'items.*.qty'      => 'required|integer|min:1',
            'items.*.price'    => 'required|numeric|min:0',

            'total'            => 'required|numeric|min:0',
        ]);

        // ─────────────────────────────
        // ORDER INFO
        // ─────────────────────────────
        $orderId   = 'PLC-' . strtoupper(substr(uniqid(), -6));
        $orderDate = now()->format('F d, Y');

        try {

            $token  = env('TELEGRAM_BOT_TOKEN');
            $chatId = env('TELEGRAM_CHAT_ID');

            $customerName = $validated['firstName'] . ' ' . $validated['lastName'];

            // ─────────────────────────────
            // MESSAGE BUILD
            // ─────────────────────────────
            $message =
                "🏢 <b>PLANEC NEW ORDER</b>\n" .
                "━━━━━━━━━━━━━━━━━━━━━━\n\n" .

                "📄 <b>ORDER INFORMATION</b>\n" .
                "• Order ID : <code>#{$orderId}</code>\n" .
                "• Date     : {$orderDate}\n\n" .

                "👤 <b>CUSTOMER DETAILS</b>\n" .
                "• Name     : {$customerName}\n" .
                "• Phone    : {$validated['phone']}\n" .
                "• Telegram : {$validated['telegram']}\n" .
                "• Email    : " . ($validated['email'] ?? 'N/A') . "\n" .
                "• Address  : {$validated['location']}\n\n" .

                "📦 <b>ORDER ITEMS</b>\n" .
                "━━━━━━━━━━━━━━━━━━━━━━\n";

            // ITEMS LOOP
            foreach ($validated['items'] as $item) {

                $subtotal = $item['qty'] * $item['price'];

                $message .=
                    "🛍 <b>{$item['name']}</b>\n" .
                    "   Quantity : {$item['qty']}\n" .
                    "   Price    : $" . number_format($item['price'], 2) . "\n" .
                    "   Subtotal : $" . number_format($subtotal, 2) . "\n\n";
            }

            // TOTAL
            $message .=
                "━━━━━━━━━━━━━━━━━━━━━━\n" .
                "💰 <b>TOTAL AMOUNT :</b> $" . number_format($validated['total'], 2) . "\n" .
                "━━━━━━━━━━━━━━━━━━━━━━";

            // SEND TO TELEGRAM
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id'    => $chatId,
                'text'       => $message,
                'parse_mode' => 'HTML'
            ]);

            Log::info('Order sent', ['orderId' => $orderId]);
        } catch (\Exception $e) {

            Log::error('Telegram failed', [
                'orderId' => $orderId,
                'error'   => $e->getMessage(),
            ]);
        }

        return response()->json([
            'success'   => true,
            'orderId'   => $orderId,
            'orderDate' => $orderDate,
            'message'   => 'Order received successfully',
        ], 201);
    }
}
