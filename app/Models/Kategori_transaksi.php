<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use App\Models\jenis_transaksi;

class Kategori_transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jenis_transaksi_id',
    ];

    public function jenis_transaksi(): belongsTo
    {
        return $this->belongsTo(Jenis_transaksi::class);
    }
}
