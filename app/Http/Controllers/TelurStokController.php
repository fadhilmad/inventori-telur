<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Telur;
use App\Models\TelurStok;
use Illuminate\Http\Request;

class TelurStokController extends Controller
{
    public function index()
    {
        $telur = Telur::select(['*'])->groupBy(['name'])->orderBy('name', 'asc')->get();

        $stok = DB::select('select b.name, a.satuan_besar, a.satuan_kecil, a.ready, b.isi_satuan_kecil from telur_stoks a join telurs b on b.id = a.telur_id');

        $stok = collect($stok);

        return view('stok.index', compact('telur', 'stok'));
    }
}
