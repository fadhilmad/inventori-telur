<?php

namespace App\Http\Controllers;

use App\Models\Telur;
use App\Models\TransaksiKeluar;
use App\Models\TransaksiMasuk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $telur = Telur::count();

        $tMasuk = TransaksiMasuk::count();

        $tKeluar = TransaksiKeluar::count();

        return view('dashboard', compact('telur', 'tMasuk', 'tKeluar'));
    }
}
