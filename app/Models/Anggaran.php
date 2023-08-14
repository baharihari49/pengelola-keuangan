<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori_transaksi;
use Illuminate\Database\Eloquent\Relations\belongsTo;


class Anggaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah',
        'kategori_transaksi_id',
        'user_id',
        'tanggal_mulai',
        'tanggal_berakhir'
    ];

    public function kategori_transaksi(): belongsTo
    {
        return $this->belongsTo(Kategori_transaksi::class);
    }
}
