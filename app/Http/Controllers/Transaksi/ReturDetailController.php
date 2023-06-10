<?php

namespace App\Http\Controllers\Transaksi;

use DB;
use Log;
use App\Http\Controllers\Controller;
use App\Models\TelurStok;
use App\Models\TransaksiRetur;
use App\Models\TransaksiReturDetail;
use App\Http\Requests\StoreTransaksiReturDetailRequest;
use Illuminate\Http\Request;

class ReturDetailController extends Controller
{

    public function store(StoreTransaksiReturDetailRequest $request, TransaksiRetur $retur)
    {
        $check = TransaksiReturDetail::where('telur_id', $request->telur_id)
            ->where('transaksi_retur_id', $retur->id)->count();

        if ($check > 0) {
            alert('Woops!', 'Telur sudah ditambahkan.', 'warning');

            return redirect()->route('transaksi.retur.show', $retur->id);
        }

        DB::beginTransaction();
        try {
            $stok = TelurStok::find($request->telur_stok_id);

            $stok->ready = $stok->ready - $request->qty;
            $stok->save();


            TransaksiReturDetail::create($request->except(['_token']));

            toast('Data berhasil disimpan', 'success');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            Log::error("Tidak dapat menambahkan transaksi ke stok, error : " . $th->getMessage());

            toast('Tidak dapat menambahkan transaksi ke stok', 'warning');
        }

        return redirect()->route('transaksi.retur.show', $retur->id);
    }


    public function destroy(TransaksiRetur $retur, TransaksiReturDetail $detail)
    {
        DB::beginTransaction();
        try {
            $stok = TelurStok::find($detail->telur_stok_id);

            $stok->ready = $stok->ready + $detail->qty;
            $stok->save();


            TransaksiReturDetail::destroy($detail->id);

            toast('Data berhasil disimpan', 'success');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            Log::error("Tidak dapat menambahkan transaksi ke stok, error : " . $th->getMessage());

            toast('Tidak dapat menambahkan transaksi ke stok', 'warning');
        }

        return redirect()->route('transaksi.retur.show', $retur->id);
    }
}
