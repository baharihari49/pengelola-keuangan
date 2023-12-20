<?php

namespace App\Http\Middleware;

use App\Models\Payment;
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
        $user = User::where('id', auth()->user()->id)->with('payment')->first();
        $payment = Payment::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->first() ?? '';


        if ($user->payment_id != null && $payment != '' && $payment->status == 'pending') {
            session()->flash('free', 'berlangganan sekarang');
        } else if ($user->payment_id == null) {
            session()->flash('free', 'berlangganan sekarang');
        } else if ($payment != '' && $payment->status == 'expired') {
            session()->flash('expired', 'berlangganan sekarang');
        }


        return $next($request);
    }
}
