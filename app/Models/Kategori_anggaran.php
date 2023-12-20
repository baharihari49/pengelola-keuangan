<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori_anggaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'value',
        'user_id',
    ];

    public function Anggaran(): HasMany
    {
        return $this->hasMany(Anggaran::class);
    }
}
