<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | This tells Laravel which frontend origins (URLs) are allowed to send
    | requests to your API. If your Vue app's URL is not listed here,
    | the browser will block the request with a CORS error.
    |
    */

    // Which URL paths CORS rules apply to.
    // 'api/*' means all routes under /api/  (your Vue calls POST /api/orders)
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Which HTTP methods are allowed from the frontend
    'allowed_methods' => ['*'],  // * = GET, POST, PUT, DELETE, etc.

    // ── ALLOWED ORIGINS ────────────────────────────────────────────────────
    // Add every URL your Vue frontend runs on.
    // DO NOT add a trailing slash: 'http://localhost:5173' ✅
    //                                'http://localhost:5173/' ❌
    'allowed_origins' => [
        'http://localhost:5173',       // Vue dev server (Vite default)
        'http://localhost:3000',       // Vue dev server (alternative port)
        'http://localhost:8080',       // Vue CLI default port
        'http://127.0.0.1:5173',      // same as above but with IP

        // ── When you deploy, add your real domain here ──
        // 'https://planec.com.kh',
        // 'https://www.planec.com.kh',
        // 'https://shop.planec.com.kh',
    ],

    // Regex patterns for allowed origins (leave empty if using allowed_origins)
    'allowed_origins_patterns' => [],

    // Which request headers the frontend is allowed to send
    'allowed_headers' => ['*'],  // * = Content-Type, Authorization, Accept, etc.

    // Which response headers the browser is allowed to read
    'exposed_headers' => [],

    // How long (seconds) the browser caches the CORS preflight response
    // 0 = no cache, 3600 = 1 hour
    'max_age' => 3600,

    // Allow cookies / auth tokens to be sent cross-origin
    // Set to true only if you use Laravel Sanctum session auth
    'supports_credentials' => false,

];