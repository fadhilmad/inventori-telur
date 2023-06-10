<?php

namespace App\Models;

use App\Models\TransaksiMasuk;
use App\Models\Telur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiMasukDetail extends Model
{
    use HasFactory;

    public $guarded = [];

    /**
     * Get the tMasuk that owns the TransaksiMasukDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tMasuk(): BelongsTo
    {
        return $this->belongsTo(TransaksiMasuk::class);
    }

    /**
     * Get the telur that owns the TransaksiMasukDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function telur(): BelongsTo
    {
        return $this->belongsTo(Telur::class);
    }
}
