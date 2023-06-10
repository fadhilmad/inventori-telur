<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class TransaksiReturDetail extends Model
{
    use HasFactory;

    public $guarded = [];
    /**
     * Get the tRetur that owns the TransaksiReturDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tRetur(): BelongsTo
    {
        return $this->belongsTo(TransaksiRetur::class);
    }

    /**
     * Get the telur that owns the TransaksiReturDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function telur(): BelongsTo
    {
        return $this->belongsTo(Telur::class);
    }

    public function stok(): BelongsTo
    {
        return $this->belongsTo(TelurStok::class, 'telur_stok_id', 'id');
    }
}
