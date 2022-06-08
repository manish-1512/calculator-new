<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'register',
        'login','calculate-premium/two-wheeler-one-year',
        'calculate-premium',
        'forgot-password',
        'verify-otp',
        'reset-password',
        'logout',
        'policies',
        'dynamic-fields',
        'calculate-premium/two-wheeler-five-year',
        'calculate-premium/private-car-one-year',
        'calculate-premium/private-car-three-year',
        'calculate-premium/goods-carrying-public',
        'calculate-premium/goods-carrying-private',
        'calculate-premium/three-wheeler-goods-carrying-public',
        'calculate-premium/three-wheeler-goods-carrying-private',
        'calculate-premium/three-wheeler-pcv-upto-6-passengers',
        'calculate-premium/three-wheeler-pcv-upto-17-passengers',
        'calculate-premium/four-wheeler-upto-6-passengers-taxi',
        'calculate-premium/two-wheeler-cc-data',
        'calculate-premium/private-car-cc-data',
        'calculate-premium/goods-carrying-public-kg-tp-rate',
        'calculate-premium/four-wheeler-above-6-passengers-bus',
        'calculate-premium/four-wheeler-above-6-school-bus',
        'calculate-premium/goods-carrying-private-kg-tp-rate',
        

    ];
}
