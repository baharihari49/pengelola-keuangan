<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use App\Models\jenis_transaksi;
use App\Models\Kategori_transaksi;

class Transaksi extends Model
{
    use HasUuids;
    use HasFactory;

    public function uniqueIds(): array
    {   
        return ['uuid', 'uuid'];
    }

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'tanggal',
        'id',
        'jumlah',
        'kategori_transaksi_id',
        'jenis_transaksi_id',
        'deskripsi',
        'user_id',
        'show',
        'anggaran'
    ];

    public function kategori_transaksi(): belongsTo
    {
        return $this->belongsTo(Kategori_transaksi::class);
    }

    public function jenis_transaksi(): belongsTo
    {
        return $this->belongsTo(jenis_transaksi::class);
    }
}
