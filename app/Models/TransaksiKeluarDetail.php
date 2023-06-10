<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class TransaksiKeluarDetail extends Model
{
    use HasFactory;

    public $guarded = [];
    /**
     * Get the tKeluar that owns the TransaksiKeluarDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tKeluar(): BelongsTo
    {
        return $this->belongsTo(TransaksiKeluar::class);
    }

    /**
     * Get the telur that owns the TransaksiKeluarDetail
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
