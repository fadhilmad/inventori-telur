<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiRetur extends Model
{
    use HasFactory;

    public $guarded  = [];

    public function details()
    {
        return $this->hasMany(TransaksiReturDetail::class);
    }
}
