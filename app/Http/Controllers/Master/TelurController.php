<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Telur;
use App\Http\Requests\StoreTelurRequest;
use App\Http\Requests\UpdateTelurRequest;
use App\Models\SatuanBesar;
use App\Models\SatuanKecil;

class TelurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $telurs = Telur::select('*')->with(['satuanBesar', 'satuanKecil'])->get();

        confirmDelete('Apakah kamu yakin akan menghapus data ini ?', 'Data yang sudah dihapus tidak dapat dikembalikan.');

        return view('master-data.telur.index', compact('telurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $satuanBesar = SatuanBesar::all();
        $satuanKecil = SatuanKecil::all();

        return view('master-data.telur.create', compact('satuanBesar', 'satuanKecil'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTelurRequest $request)
    {
        Telur::create($request->except(['_token']));

        toast('Data berhasil disimpan', 'success');

        return redirect()->route('master-data.telur.index');
    }

    public function edit(Telur $telur)
    {
        $satuanBesar = SatuanBesar::all();
        $satuanKecil = SatuanKecil::all();

        return view('master-data.telur.edit', compact('telur', 'satuanBesar', 'satuanKecil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTelurRequest $request, Telur $telur)
    {
        Telur::find($telur->id)->update($request->except(['_token', '_method']));

        toast('Data berhasil diubah', 'success');

        return redirect()->route('master-data.telur.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Telur $telur)
    {
        Telur::destroy($telur->id);

        toast('Data berhasil dihapus', 'success');

        return redirect()->route('master-data.telur.index');
    }
}
