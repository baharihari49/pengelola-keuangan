<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\DatabaseHelper;

class CheckNewUserCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!DatabaseHelper::checkNewUser()) {
             session()->flash('alert', 'Lengkapi profil Anda sebelum melanjutkan.');
        }
        return $next($request);
    }
}
