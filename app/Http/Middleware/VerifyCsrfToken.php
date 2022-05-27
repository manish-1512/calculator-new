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
        'register','login','calculate-premium/two-wheeler-one-year',
        'calculate-premium/two-wheeler-five-year',
        'calculate-premium/private-car-one-year',
        'calculate-premium/private-car-three-year',
        'calculate-premium/goods-carrying-public',
        'calculate-premium/goods-carrying-private',
        'calculate-premium/three-wheeler-goods-carrying-public',
        'calculate-premium/three-wheeler-goods-carrying-private',
        'calculate-premium/three-wheeler-pcv-upto-6-passengers',
        'calculate-premium/three-wheeler-pcv-upto-17-passengers',
    ];
}
