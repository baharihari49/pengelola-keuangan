<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'amount',
        'type',
        'expired_date',
        'redirect_url',
        'is_address_required',
        'is_phone_number_required',
        'langganan_berakhir',
    ];

    public function user(): BelongsTo // Perbaiki BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
