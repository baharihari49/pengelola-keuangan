<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;
use Laravel\Pulse\Facades\Pulse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Pulse::users(function ($ids) {
            return User::findMany($ids)->map(fn ($user) => [
                'id' => $user->nama ? $user->id : null,
                'name' => $user->username,
                'extra' => $user->email,
                'avatar' => $user->foto,
            ]);
        });
    }
}
