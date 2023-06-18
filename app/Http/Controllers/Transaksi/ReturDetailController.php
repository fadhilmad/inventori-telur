<?php

namespace App\Http\Controllers\Transaksi;

use DB;
use Log;
use App\Http\Controllers\Controller;
use App\Models\Telur;
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

                TransaksiReturDetail::create($request->except(['_token']));
            }

            toast('Data berhasil disimpan', 'success');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            Log::error("Tidak dapat menambahkan transaksi ke stok, error : " . $th->getMessage());

            toast('Tidak dapat menambahkan transaksi ke stok', 'warning');
        }

        return redirect()->route('transaksi.retur.show', $retur->id);
    }


    public function destroy(TransaksiRetur $retur, Telur $telur)
    {
        DB::beginTransaction();
        try {
            $details = TransaksiReturDetail::where('transaksi_retur_id', $retur->id)
                ->where('telur_id', $telur->id)
                ->get();

            foreach ($details as $key => $detail) {
                $stok = TelurStok::find($detail->telur_stok_id);
                $stok->ready = $stok->ready + $detail->qty;
                $stok->keluar = $stok->keluar - $detail->qty;
                $stok->save();
                TransaksiReturDetail::destroy($detail->id);
            }

            toast('Data berhasil dihapus', 'success');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            Log::error("Tidak dapat menambahkan transaksi ke stok, error : " . $th->getMessage());

            toast('Tidak dapat menambahkan transaksi ke stok', 'warning');
        }

        return redirect()->route('transaksi.retur.show', $retur->id);
    }
}
