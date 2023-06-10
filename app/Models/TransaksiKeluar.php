<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKeluar extends Model
{
    use HasFactory;

    protected $table = 'transaksi_keluar';

    public $guarded  = [];

    public function details()
    {
        return $this->hasMany(TransaksiKeluarDetail::class);
    }
}
