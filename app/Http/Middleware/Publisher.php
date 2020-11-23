<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class Publisher
{

    public function handle(Request $request, Closure $next)
    {
        if(!isset(Auth::user()->publisher) || Auth::user()->publisher === 0 || !Auth::check()) {
            return new Response('Forbidden', 403);
        }
        return $next($request);
    }
}
