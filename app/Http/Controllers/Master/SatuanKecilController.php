<?php

namespace App\Http\Controllers\Master;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\SatuanKecil;
use App\Http\Requests\StoreSatuanKecilRequest;
use App\Http\Requests\UpdateSatuanKecilRequest;

class SatuanKecilController extends Controller
{
    public function index()
    {
        $satuans = SatuanKecil::all();

        confirmDelete('Apakah kamu yakin akan menghapus data ini ?', 'Data yang sudah dihapus tidak dapat dikembalikan.');

        return view('master-data.satuan-kecil.index', compact('satuans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master-data.satuan-kecil.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSatuanKecilRequest $request)
    {

        SatuanKecil::create($request->only(['name']));

        Alert::toast('Data berhasil disimpan', 'success');

        return redirect()->route('master-data.satuan-kecil.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SatuanKecil $satuanKecil)
    {
        return view('master-data.satuan-kecil.edit', compact('satuanKecil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSatuanKecilRequest $request, SatuanKecil $satuanKecil)
    {

        SatuanKecil::find($satuanKecil->id)->update($request->only(['name']));

        Alert::toast('Data berhasil diubah', 'success');

        return redirect()->route('master-data.satuan-kecil.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SatuanKecil $satuanKecil)
    {
        SatuanKecil::destroy($satuanKecil->id);

        Alert::toast('Data berhasil dihapus', 'success');

        return redirect()->route('master-data.satuan-kecil.index');
    }
}
