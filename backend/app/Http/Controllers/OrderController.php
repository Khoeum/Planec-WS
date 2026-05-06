<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Mail\OrderReceived;

class OrderController extends Controller
{
    /**
     * POST /api/orders
     */
    public function store(Request $request): JsonResponse
    {
        // ── 1. VALIDATE ─────────────────────────────
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

        // ── 2. ORDER INFO ───────────────────────────
        $orderId   = 'PLC-' . strtoupper(substr(uniqid(), -6));
        $orderDate = now()->format('F d, Y h:i A');

        $orderData = array_merge($validated, [
            'orderId'   => $orderId,
            'orderDate' => $orderDate,
        ]);

        // ── 4. TELEGRAM INVOICE ─────────────────────
        try {
            $token  = env('TELEGRAM_BOT_TOKEN');
            $chatId = env('TELEGRAM_CHAT_ID');

            $message =
                "🏢 <b>PLANEC ORDER INVOICE</b>\n" .
                "━━━━━━━━━━━━━━━━━━━━━━\n\n" .

                "🆔 <b>Order ID:</b> <code>#{$orderId}</code>\n" .
                "📅 <b>Date:</b> {$orderDate}\n\n" .

                "👤 <b>CUSTOMER DETAILS</b>\n" .
                "━━━━━━━━━━━━━━━━━━━━━━\n" .
                "• Name      : {$validated['firstName']} {$validated['lastName']}\n" .
                "• Phone     : {$validated['phone']}\n" .
                "• Telegram  : {$validated['telegram']}\n" .
                "• Email     : {$validated['email']}\n" .
                "• Location  : {$validated['location']}\n\n" .

                "📦 <b>ORDER ITEMS</b>\n" .
                "━━━━━━━━━━━━━━━━━━━━━━\n";

            foreach ($validated['items'] as $item) {
                $subtotal = $item['qty'] * $item['price'];

                $message .=
                    "▫️ <b>{$item['name']}</b>\n" .
                    "   Qty: {$item['qty']} | $" . number_format($item['price'], 2) .
                    " | Subtotal: $" . number_format($subtotal, 2) . "\n\n";
            }

            $message .=
                "━━━━━━━━━━━━━━━━━━━━━━\n" .
                "💰 <b>TOTAL:</b> $" . number_format($validated['total'], 2) . "\n" .
                "━━━━━━━━━━━━━━━━━━━━━━\n\n" .

                "⚡ <b>Status:</b> <i>NEW ORDER RECEIVED</i>\n" .
                "🤖 <b>System:</b> Vue + Laravel + Telegram API\n";

            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML'
            ]);

            Log::info('Telegram sent', ['orderId' => $orderId]);
        } catch (\Exception $e) {
            Log::error('Telegram failed', [
                'orderId' => $orderId,
                'error'   => $e->getMessage(),
            ]);
        }

        // ── 5. RESPONSE ─────────────────────────────
        return response()->json([
            'success'   => true,
            'orderId'   => $orderId,
            'orderDate' => $orderDate,
            'message'   => 'Order placed successfully!',
        ], 201);
    }
}
