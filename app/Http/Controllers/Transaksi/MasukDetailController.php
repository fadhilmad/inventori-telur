<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\TransaksiMasukDetail;
use App\Http\Requests\StoreTransaksiMasukDetailRequest;
use App\Http\Requests\UpdateTransaksiMasukDetailRequest;
use App\Models\TransaksiMasuk;

class MasukDetailController extends Controller
{
    public function store(StoreTransaksiMasukDetailRequest $request, TransaksiMasuk $masuk)
    {
        $check = TransaksiMasukDetail::where('telur_id', $request->telur_id)->where('transaksi_masuk_id', $masuk->id)->count();

        if ($check > 0) {
            alert('Woops!', 'Telur sudah ditambahkan.', 'warning');

            return redirect()->route('transaksi.masuk.show', $masuk->id);
        }

        $request->merge([
            'total' => $request->isi_satuan_kecil * $request->qty_satuan_besar
        ]);

        TransaksiMasukDetail::create($request->except(['_token']));

        toast('Data berhasil disimpan', 'success');

        return redirect()->route('transaksi.masuk.show', $masuk->id);
    }


    public function destroy(TransaksiMasuk $masuk, TransaksiMasukDetail $detail)
    {
        TransaksiMasukDetail::destroy($detail->id);

        toast('Data berhasil dihapus', 'success');

        return redirect()->route('transaksi.masuk.show', ['masuk' => $masuk->id]);
    }
}
