<?php

namespace App\Http\Controllers\Transaksi;

use DB;
use Log;
use App\Http\Controllers\Controller;
use App\Models\TransaksiKeluarDetail;
use App\Http\Requests\StoreTransaksiKeluarDetailRequest;
use App\Models\TelurStok;
use App\Models\TransaksiKeluar;

class KeluarDetailController extends Controller
{

    public function store(StoreTransaksiKeluarDetailRequest $request, TransaksiKeluar $keluar)
    {
        $check = TransaksiKeluarDetail::where('telur_id', $request->telur_id)
            ->where('transaksi_keluar_id', $keluar->id)->count();

        if ($check > 0) {
            alert('Woops!', 'Telur sudah ditambahkan.', 'warning');

            return redirect()->route('transaksi.keluar.show', $keluar->id);
        }

        DB::beginTransaction();
        try {
            $stok = TelurStok::find($request->telur_stok_id);

            $stok->ready = $stok->ready - $request->qty;
            $stok->save();


            TransaksiKeluarDetail::create($request->except(['_token']));

            toast('Data berhasil disimpan', 'success');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            Log::error("Tidak dapat menambahkan transaksi ke stok, error : " . $th->getMessage());

            toast('Tidak dapat menambahkan transaksi ke stok', 'warning');
        }

        return redirect()->route('transaksi.keluar.show', $keluar->id);
    }


    public function destroy(TransaksiKeluar $keluar, TransaksiKeluarDetail $detail)
    {
        DB::beginTransaction();
        try {
            $stok = TelurStok::find($detail->telur_stok_id);

            $stok->ready = $stok->ready + $detail->qty;
            $stok->save();


            TransaksiKeluarDetail::destroy($detail->id);

            toast('Data berhasil disimpan', 'success');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            Log::error("Tidak dapat menambahkan transaksi ke stok, error : " . $th->getMessage());

            toast('Tidak dapat menambahkan transaksi ke stok', 'warning');
        }

        return redirect()->route('transaksi.keluar.show', $keluar->id);
    }
}
