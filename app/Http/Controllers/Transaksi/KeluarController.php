<?php

namespace App\Http\Controllers\Transaksi;

use DB;
use App\Cetak\NotaKeluar;
use App\Cetak\LaporanKeluar;
use App\Models\TransaksiKeluar;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransaksiKeluarRequest;
use App\Http\Requests\UpdateTransaksiKeluarRequest;

class KeluarController extends Controller
{
    use LaporanKeluar, NotaKeluar;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keluar = TransaksiKeluar::select(['*'])->get();

        confirmDelete('Apakah kamu yakin akan menghapus data ini ?', 'Data yang sudah dihapus tidak dapat dikembalikan.');

        return view('transaksi.keluar.index', compact('keluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaksi.keluar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksiKeluarRequest $request)
    {
        TransaksiKeluar::create($request->except(['_token']));

        toast('Data berhasil disimpan', 'success');

        return redirect()->route('transaksi.keluar.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TransaksiKeluar $keluar)
    {

        $telurs = DB::select('select a.id, a.telur_id, b.name, a.satuan_besar, a.satuan_kecil, a.ready, b.isi_satuan_kecil from telur_stoks a join telurs b on b.id = a.telur_id');

        $telurs = collect($telurs);

        $keluar->load('details', 'details.telur', 'details.stok');

        confirmDelete('Apakah kamu yakin akan menghapus data ini ?', 'Data yang sudah dihapus tidak dapat dikembalikan.');

        return view('transaksi.keluar.show', compact('keluar', 'telurs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransaksiKeluar $keluar)
    {
        return view('transaksi.keluar.edit', compact('keluar'));
    }

    public function selesai(TransaksiKeluar $keluar)
    {
        TransaksiKeluar::find($keluar->id)->update(['status' => 'dikirim']);

        toast('Transaksi berhasil dikirim', 'success');

        return redirect()->route('transaksi.keluar.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiKeluarRequest $request, TransaksiKeluar $keluar)
    {
        TransaksiKeluar::find($keluar->id)->update($request->except(['_token', '_method']));

        toast('Data berhasil diubah', 'success');

        return redirect()->route('transaksi.keluar.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransaksiKeluar $keluar)
    {
        TransaksiKeluar::destroy($keluar->id);

        toast('Data berhasil dihapus', 'success');

        return redirect()->route('transaksi.keluar.index');
    }
}
