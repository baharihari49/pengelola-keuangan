<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Gunakan BelongsTo dengan huruf kapital

class suppliers_or_customers extends Model // Sesuaikan nama model dengan huruf kapital
{
    use HasFactory;

    // protected $table = 'suppliers_or_customers'; // Sesuaikan nama tabel
    // protected $primaryKey = 'email';
    protected $fillable = [
        'nama_bisnis',
        'alamat',
        'email',
        'no_hp',
        'jenis_transaksi_id',
        'user_id'
    ];

    public function jenis_transaksi(): BelongsTo // Perbaiki BelongsTo
    {
        return $this->belongsTo(Jenis_transaksi::class);
    }
}



