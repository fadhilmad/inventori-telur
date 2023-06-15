<?php

namespace App\Http\Controllers\Transaksi;

use DB;
use Log;
use App\Http\Controllers\Controller;
use App\Models\TransaksiKeluarDetail;
use App\Http\Requests\StoreTransaksiKeluarDetailRequest;
use App\Models\Telur;
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
            $stok = TelurStok::where('telur_id', $request->telur_id)->orderBy('id', 'asc')->get();

            $dijual = $request->qty;

            foreach ($stok as $key => $item) {
                if ($dijual == 0) {
                    break;
                }

                $tersedia = $item->ready;

                $sisa     = $tersedia - $dijual;

                $stokTerjual = 0;

                if ($dijual - $tersedia < 0) {
                    $stokTerjual = $dijual;
                } else {
                    $stokTerjual = $tersedia;
                }

                $dijual -= $tersedia;

                $dijual      = $dijual < 0 ? 0 : $dijual;
                $sisa        = $sisa < 0 ? 0 : $sisa;

                $updateStok = [
                    'ready' => $sisa,
                    'keluar' => $item->keluar + $stokTerjual
                ];

                TelurStok::where('id', $item->id)->update($updateStok);

                $request->merge([
                    'telur_stok_id' => $item->id,
                    'qty' => $stokTerjual,
                ]);

                TransaksiKeluarDetail::create($request->except(['_token']));
            }

            toast('Data berhasil disimpan', 'success');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            Log::error("Tidak dapat menambahkan transaksi ke stok, error : " . $th->getMessage());

            toast('Tidak dapat menambahkan transaksi ke stok', 'warning');
        }

        return redirect()->route('transaksi.keluar.show', $keluar->id);
    }


    public function destroy(TransaksiKeluar $keluar, Telur $telur)
    {
        DB::beginTransaction();
        try {
            $details = TransaksiKeluarDetail::where('transaksi_keluar_id', $keluar->id)
                ->where('telur_id', $telur->id)
                ->get();

            foreach ($details as $key => $detail) {
                $stok = TelurStok::find($detail->telur_stok_id);
                $stok->ready = $stok->ready + $detail->qty;
                $stok->keluar = $stok->keluar - $detail->qty;
                $stok->save();
                TransaksiKeluarDetail::destroy($detail->id);
            }

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
