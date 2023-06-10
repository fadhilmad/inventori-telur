<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Telur extends Model
{
    use HasFactory, SoftDeletes;

    public $guarded = [];

    public function satuanBesar()
    {
        return $this->belongsTo(SatuanBesar::class, 'satuan_besar_id');
    }

    public function satuanKecil()
    {
        return $this->belongsTo(SatuanKecil::class, 'satuan_kecil_id');
    }

    public function stok()
    {
        return $this->hasMany(TelurStok::class);
    }
}
