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

    // protected $addHttpCookie = true;
    protected $except = [
        'http://127.0.0.1:8000/product',
        'http://127.0.0.1:8000/product/*',
        'http://127.0.0.1:8000/register',
        'http://127.0.0.1:8000/login',
        'http://127.0.0.1:8000/addToCart',
        'http://127.0.0.1:8000/addToCart/*',
        'http://127.0.0.1:8000/checkout',
        'http://127.0.0.1:8000/createOrder',
        'https://cma-laravel.herokuapp.com/product',
        'https://cma-laravel.herokuapp.com/product/*',
        'https://cma-laravel.herokuapp.com/register',
        'https://cma-laravel.herokuapp.com/login',
        'https://cma-laravel.herokuapp.com/addToCart',
        'https://cma-laravel.herokuapp.com/addToCart/*',
        'https://cma-laravel.herokuapp.com/checkout',
        'https://cma-laravel.herokuapp.com/createOrder',
        'http://cma-laravel.herokuapp.com/product',
        'http://cma-laravel.herokuapp.com/product/*',
        'http://cma-laravel.herokuapp.com/register',
        'http://cma-laravel.herokuapp.com/login',
        'http://cma-laravel.herokuapp.com/addToCart',
        'http://cma-laravel.herokuapp.com/addToCart/*',
        'http://cma-laravel.herokuapp.com/checkout',
        'http://cma-laravel.herokuapp.com/createOrder',

        // 'auth/facebook/callback',
        // 'auth/google/callback',
    ];
}
