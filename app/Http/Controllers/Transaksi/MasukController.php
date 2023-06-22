<?php

namespace App\Http\Controllers\Transaksi;

use DB;
use App\Cetak\LaporanMasuk;
use App\Models\Suplier;
use App\Http\Controllers\Controller;
use App\Models\TransaksiMasuk;
use App\Http\Requests\StoreTransaksiMasukRequest;
use App\Http\Requests\UpdateTransaksiMasukRequest;
use App\Models\Telur;
use App\Models\TelurStok;
use Log;

class MasukController extends Controller
{
    use LaporanMasuk;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masuk = TransaksiMasuk::select(['*'])->with('suplier')->get();

        confirmDelete('Apakah kamu yakin akan menghapus data ini ?', 'Data yang sudah dihapus tidak dapat dikembalikan.');

        return view('transaksi.masuk.index', compact('masuk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suplier = Suplier::all();

        return view('transaksi.masuk.create', compact('suplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksiMasukRequest $request)
    {
        TransaksiMasuk::create($request->except(['_token']));

        toast('Data berhasil disimpan', 'success');

        return redirect()->route('transaksi.masuk.index');
    }

    public function insertStok(TransaksiMasuk $masuk)
    {

        try {
            DB::beginTransaction();

            foreach ($masuk->details as $key => $detail) {
                TelurStok::create([
                    'telur_id' => $detail->telur_id,
                    'transaksi_masuk_id' => $detail->transaksi_masuk_id,
                    'transaksi_masuk_detail_id' => $detail->id,
                    'satuan_besar' => $detail->satuan_besar,
                    'satuan_kecil' => $detail->satuan_kecil,
                    'masuk' => $detail->total,
                    'keluar' => 0,
                    'ready' => $detail->total
                ]);
            }

            $masuk->insert_stok = 'sudah';
            $masuk->save();

            DB::commit();
        } catch (\ThrowableE $th) {
            DB::rollback();

            Log::error("Tidak dapat menambahkan transaksi ke stok, error : " . $th->getMessage());

            toast('Tidak dapat menambahkan transaksi ke stok', 'error');

            return redirect()->route('transaksi.masuk.show', ['masuk' => $masuk->id]);
        }

        toast('Data berhasil ditambahkan ke stok', 'success');

        return redirect()->route('transaksi.masuk.show', ['masuk' => $masuk->id]);
    }

    public function show(TransaksiMasuk $masuk)
    {
        $suplier = Suplier::all();

        $telurs = Telur::all();

        $masuk->load('details', 'details.telur');

        confirmDelete('Apakah kamu yakin akan menghapus data ini ?', 'Data yang sudah dihapus tidak dapat dikembalikan.');

        return view('transaksi.masuk.show', compact('masuk', 'suplier', 'telurs'));
    }

    public function edit(TransaksiMasuk $masuk)
    {
        $suplier = Suplier::all();

        return view('transaksi.masuk.edit', compact('suplier', 'masuk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiMasukRequest $request, TransaksiMasuk $masuk)
    {
        TransaksiMasuk::find($masuk->id)->update($request->except(['_token', '_method']));

        toast('Data berhasil diubah', 'success');

        return redirect()->route('transaksi.masuk.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransaksiMasuk $masuk)
    {
        TransaksiMasuk::destroy($masuk->id);

        toast('Data berhasil dihapus', 'success');

        return redirect()->route('transaksi.masuk.index');
    }
}
