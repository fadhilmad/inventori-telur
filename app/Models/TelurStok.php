<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class TelurStok extends Model
{
    use HasFactory;

    public $guarded = [];

    /**
     * Get the telur that owns the TelurStok
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function telur(): BelongsTo
    {
        return $this->belongsTo(Telur::class);
    }
}
