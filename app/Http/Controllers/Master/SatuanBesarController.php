<?php

namespace App\Http\Controllers\Master;

use App\Models\SatuanBesar;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreSatuanBesarRequest;
use App\Http\Requests\UpdateSatuanBesarRequest;

class SatuanBesarController extends Controller
{
    public function index()
    {
        $satuans = SatuanBesar::all();

        confirmDelete('Apakah kamu yakin akan menghapus data ini ?', 'Data yang sudah dihapus tidak dapat dikembalikan.');

        return view('master-data.satuan-besar.index', compact('satuans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master-data.satuan-besar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSatuanBesarRequest $request)
    {

        SatuanBesar::create($request->only(['name']));

        Alert::toast('Data berhasil disimpan', 'success');

        return redirect()->route('master-data.satuan-besar.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SatuanBesar $satuanBesar)
    {
        return view('master-data.satuan-besar.edit', compact('satuanBesar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSatuanBesarRequest $request, SatuanBesar $satuanBesar)
    {

        SatuanBesar::find($satuanBesar->id)->update($request->only(['name']));

        Alert::toast('Data berhasil diubah', 'success');

        return redirect()->route('master-data.satuan-besar.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SatuanBesar $satuanBesar)
    {
        SatuanBesar::destroy($satuanBesar->id);

        Alert::toast('Data berhasil dihapus', 'success');

        return redirect()->route('master-data.satuan-besar.index');
    }
}
