<?php

namespace App\Http\Controllers\Transaksi;

use DB;
use App\Http\Controllers\Controller;
use App\Models\TransaksiRetur;
use App\Http\Requests\StoreTransaksiReturRequest;
use App\Http\Requests\UpdateTransaksiReturRequest;

class ReturController extends Controller
{
    public function index()
    {
        $retur = TransaksiRetur::select(['*'])->get();

        confirmDelete('Apakah kamu yakin akan menghapus data ini ?', 'Data yang sudah dihapus tidak dapat dikembalikan.');

        return view('transaksi.retur.index', compact('retur'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaksi.retur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksiReturRequest $request)
    {
        TransaksiRetur::create($request->except(['_token']));

        toast('Data berhasil disimpan', 'success');

        return redirect()->route('transaksi.retur.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TransaksiRetur $retur)
    {

        $telurs = DB::select('select a.id, a.telur_id, b.name, a.satuan_besar, a.satuan_kecil, a.ready, b.isi_satuan_kecil from telur_stoks a join telurs b on b.id = a.telur_id');

        $telurs = collect($telurs);

        $retur->load('details', 'details.telur', 'details.stok');

        confirmDelete('Apakah kamu yakin akan menghapus data ini ?', 'Data yang sudah dihapus tidak dapat dikembalikan.');

        return view('transaksi.retur.show', compact('retur', 'telurs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransaksiRetur $retur)
    {
        return view('transaksi.retur.edit', compact('retur'));
    }

    public function selesai(TransaksiRetur $retur)
    {
        TransaksiRetur::find($retur->id)->update(['status' => 'dikonfirmasi']);

        toast('Retur berhasil dikonfirmasi', 'success');

        return redirect()->route('transaksi.retur.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiReturRequest $request, TransaksiRetur $retur)
    {
        TransaksiRetur::find($retur->id)->update($request->except(['_token', '_method']));

        toast('Data berhasil diubah', 'success');

        return redirect()->route('transaksi.retur.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransaksiRetur $retur)
    {
        TransaksiRetur::destroy($retur->id);

        toast('Data berhasil dihapus', 'success');

        return redirect()->route('transaksi.retur.index');
    }
}
