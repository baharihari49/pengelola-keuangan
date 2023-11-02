<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;
    
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    public function checkNewUser()
    {
        return !empty($this->name) && !empty($this->alamat) && !empty($this->no_handphone);
    }
}
