<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiMasuk extends Model
{
    use HasFactory;

    protected $table = 'transaksi_masuk';

    public $guarded  = [];

    public function suplier()
    {
        return $this->belongsTo(Suplier::class);
    }

    public function details()
    {
        return $this->hasMany(TransaksiMasukDetail::class);
    }
}
