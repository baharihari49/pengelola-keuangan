<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasRoles, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    public function payment() : belongsTo
    {
        return $this->belongsTo(Payment::class);
    }
    public function checkNewUser()
    {
        return !empty($this->name) && !empty($this->alamat) && !empty($this->no_handphone);
    }

}
