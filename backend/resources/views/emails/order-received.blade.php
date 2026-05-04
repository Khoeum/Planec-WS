<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>New Order — PLANEC</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: Arial, sans-serif;
      background: #f0f4f8;
      padding: 32px 16px;
      color: #1a2540;
    }
    .wrapper {
      max-width: 580px;
      margin: 0 auto;
    }

    /* ── Header ── */
    .header {
      background: linear-gradient(135deg, #071e3d 0%, #0b3d5e 60%, #0d6e6e 100%);
      border-radius: 16px 16px 0 0;
      padding: 32px 36px;
      text-align: center;
    }
    .header-logo {
      font-size: 28px;
      font-weight: 900;
      letter-spacing: 4px;
      color: #ffffff;
    }
    .header-logo em {
      color: #22c55e;
      font-style: normal;
    }
    .header-tag {
      display: inline-block;
      margin-top: 10px;
      background: rgba(34,197,94,0.15);
      border: 1px solid rgba(34,197,94,0.35);
      border-radius: 999px;
      padding: 5px 18px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 2px;
      color: #4ade80;
      text-transform: uppercase;
    }

    /* ── Body Card ── */
    .card {
      background: #ffffff;
      padding: 32px 36px;
      border-left: 1px solid #e2e8f0;
      border-right: 1px solid #e2e8f0;
    }

    .alert-banner {
      background: rgba(34,197,94,0.08);
      border: 1px solid rgba(34,197,94,0.25);
      border-radius: 10px;
      padding: 14px 18px;
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 28px;
    }
    .alert-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: #22c55e;
      flex-shrink: 0;
    }
    .alert-banner p {
      font-size: 13px;
      font-weight: 700;
      color: #15803d;
    }
    .alert-banner span {
      font-size: 12px;
      color: #16a34a;
      font-weight: 400;
    }

    /* ── Section Title ── */
    .section-title {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      color: #22c55e;
      margin-bottom: 12px;
      padding-bottom: 8px;
      border-bottom: 1px solid #f1f5f9;
    }

    /* ── Info Table ── */
    .info-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 28px;
    }
    .info-table td {
      padding: 9px 0;
      font-size: 13px;
      border-bottom: 1px solid #f8fafc;
      vertical-align: top;
    }
    .info-table td:first-child {
      color: #94a3b8;
      width: 38%;
      font-size: 11px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      padding-right: 12px;
    }
    .info-table td:last-child {
      color: #0f172a;
      font-weight: 600;
    }

    /* ── Order ID badge ── */
    .order-id {
      display: inline-block;
      background: rgba(34,197,94,0.1);
      border: 1px solid rgba(34,197,94,0.3);
      border-radius: 6px;
      padding: 3px 10px;
      font-size: 13px;
      font-weight: 700;
      color: #16a34a;
      letter-spacing: 1px;
    }

    /* ── Products Table ── */
    .products-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 28px;
    }
    .products-table thead td {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: #94a3b8;
      padding: 8px 0;
      border-bottom: 2px solid #e2e8f0;
    }
    .products-table tbody td {
      padding: 11px 0;
      font-size: 13px;
      border-bottom: 1px solid #f1f5f9;
      color: #334155;
      vertical-align: middle;
    }
    .products-table tbody td:last-child {
      text-align: right;
      font-weight: 700;
      color: #0f172a;
    }
    .product-cat {
      font-size: 10px;
      color: #22c55e;
      letter-spacing: 1px;
      text-transform: uppercase;
      display: block;
      margin-bottom: 2px;
    }
    .product-name {
      font-weight: 600;
      color: #0f172a;
    }
    .qty-badge {
      display: inline-block;
      background: #f1f5f9;
      border: 1px solid #e2e8f0;
      border-radius: 4px;
      padding: 2px 8px;
      font-size: 11px;
      color: #475569;
    }

    /* ── Total Row ── */
    .total-row {
      background: #f8fafc;
      border-radius: 10px;
      padding: 16px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 28px;
      border: 1px solid #e2e8f0;
    }
    .total-label {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #64748b;
    }
    .total-amount {
      font-size: 28px;
      font-weight: 900;
      color: #22c55e;
      letter-spacing: 1px;
    }

    /* ── Notes ── */
    .notes-box {
      background: #fffbeb;
      border: 1px solid #fde68a;
      border-radius: 10px;
      padding: 14px 18px;
      margin-bottom: 28px;
    }
    .notes-box p:first-child {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #92400e;
      margin-bottom: 6px;
    }
    .notes-box p:last-child {
      font-size: 13px;
      color: #78350f;
      line-height: 1.6;
    }

    /* ── CTA ── */
    .cta-box {
      background: rgba(34,197,94,0.05);
      border: 1px solid rgba(34,197,94,0.2);
      border-radius: 10px;
      padding: 18px 20px;
      text-align: center;
      margin-bottom: 8px;
    }
    .cta-box p {
      font-size: 13px;
      color: #475569;
      line-height: 1.6;
    }
    .cta-box strong {
      color: #15803d;
    }

    /* ── Footer ── */
    .footer {
      background: #071e3d;
      border-radius: 0 0 16px 16px;
      padding: 20px 36px;
      text-align: center;
    }
    .footer p {
      font-size: 11px;
      color: rgba(255,255,255,0.4);
      letter-spacing: 0.5px;
      line-height: 1.8;
    }
    .footer a {
      color: #22c55e;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="wrapper">

    <!-- ── Header ── -->
    <div class="header">
      <div class="header-logo">PLAN<em>EC</em></div>
      <div class="header-tag">🛒 New Order Received</div>
    </div>

    <!-- ── Body ── -->
    <div class="card">

      <!-- Alert Banner -->
      <div class="alert-banner">
        <div class="alert-dot"></div>
        <div>
          <p>New order placed! <span>Please contact the customer soon.</span></p>
        </div>
      </div>

      <!-- Order Info -->
      <div class="section-title">Order Information</div>
      <table class="info-table">
        <tr>
          <td>Order ID</td>
          <td><span class="order-id">#{{ $order['orderId'] }}</span></td>
        </tr>
        <tr>
          <td>Date & Time</td>
          <td>{{ $order['orderDate'] }}</td>
        </tr>
      </table>

      <!-- Customer Info -->
      <div class="section-title">Customer Details</div>
      <table class="info-table">
        <tr>
          <td>Full Name</td>
          <td>{{ $order['firstName'] }} {{ $order['lastName'] }}</td>
        </tr>
        <tr>
          <td>Phone</td>
          <td>{{ $order['phone'] }}</td>
        </tr>
        <tr>
          <td>Telegram</td>
          <td>{{ $order['telegram'] }}</td>
        </tr>
        @if (!empty($order['email']))
        <tr>
          <td>Email</td>
          <td>{{ $order['email'] }}</td>
        </tr>
        @endif
        <tr>
          <td>Delivery Location</td>
          <td>{{ $order['location'] }}</td>
        </tr>
      </table>

      <!-- Products -->
      <div class="section-title">Products Ordered</div>
      <table class="products-table">
        <thead>
          <tr>
            <td>Product</td>
            <td>Qty</td>
            <td style="text-align:right">Subtotal</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($order['items'] as $item)
          <tr>
            <td>
              @if (!empty($item['category']))
                <span class="product-cat">{{ $item['category'] }}</span>
              @endif
              <span class="product-name">{{ $item['name'] }}</span>
            </td>
            <td><span class="qty-badge">× {{ $item['qty'] }}</span></td>
            <td>${{ number_format($item['price'] * $item['qty'], 2) }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <!-- Grand Total -->
      <div class="total-row">
        <span class="total-label">Grand Total</span>
        <span class="total-amount">${{ $order['total'] }}</span>
      </div>

      <!-- Notes (only shown if customer wrote something) -->
      @if (!empty($order['notes']))
      <div class="notes-box">
        <p>📝 Customer Notes</p>
        <p>{{ $order['notes'] }}</p>
      </div>
      @endif

      <!-- CTA -->
      <div class="cta-box">
        <p>
          Please reach out to <strong>{{ $order['firstName'] }}</strong> via
          Telegram <strong>{{ $order['telegram'] }}</strong> or
          phone <strong>{{ $order['phone'] }}</strong> to confirm the order.
        </p>
      </div>

    </div>

    <!-- ── Footer ── -->
    <div class="footer">
      <p>
        <strong style="color:rgba(255,255,255,0.7);">PLANEC</strong> — Cambodia's #1 Network Distributor<br>
        +855 23 000 000 · <a href="https://planec.com.kh">planec.com.kh</a><br>
        This email was automatically generated by the PLANEC Shop system.
      </p>
    </div>

  </div>
</body>
</html>