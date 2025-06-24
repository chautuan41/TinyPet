<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Http\Request;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
     protected $except = [
        '/shopify/products/create',
        'vnpay/payment',
    ];

    public function shouldSkipCsrfValidation(Request $request): bool
    {
        return $request->is(
            ['shopify/products/create'],
            ['/vnpay/checkout'],
        );
    }
}
