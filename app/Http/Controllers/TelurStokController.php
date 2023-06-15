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

        $stok = DB::select('select b.name, a.satuan_besar, a.satuan_kecil, b.isi_satuan_kecil, sum(a.ready) as ready from telur_stoks a join telurs b on b.id = a.telur_id group by 1,2,3,4');

        $stok = collect($stok);

        return view('stok.index', compact('telur', 'stok'));
    }
}
