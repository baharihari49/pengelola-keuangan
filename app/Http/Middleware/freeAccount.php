<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class freeAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = User::where('id', auth()->user()->id)->first();

        if($user->payment_id != null && $user->payment->status == 'pending'){
            session()->flash('free', 'berlangganan sekarang');
        }else if($user->payment->status == 'expired'){
            session()->flash('expired', 'berlangganan sekarang');
        }

        return $next($request);
    }
}
