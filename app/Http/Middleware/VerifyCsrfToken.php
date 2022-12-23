<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/product',
        '/register',
        '/shopping-cart',
        '/create-admin',
        '/transaction',
        '/transaction/midtrans-notification',
        '/payment-success',
        '/payment-cancel',
        '/payment-expired',
        '/email',
        '/address',
    ];
}
