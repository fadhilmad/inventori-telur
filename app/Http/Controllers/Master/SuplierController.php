<?php

namespace App\Http\Controllers\Master;

use App\Models\Suplier;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuplierRequest;
use App\Http\Requests\UpdateSuplierRequest;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supliers = Suplier::all();

        confirmDelete('Apakah kamu yakin akan menghapus data ini ?', 'Data yang sudah dihapus tidak dapat dikembalikan.');

        return view('master-data.suplier.index', compact('supliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master-data.suplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuplierRequest $request)
    {
        Suplier::create($request->except(['_token']));

        toast('Data berhasil disimpan', 'success');

        return redirect()->route('master-data.suplier.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suplier $suplier)
    {
        return view('master-data.suplier.edit', compact('suplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuplierRequest $request, Suplier $suplier)
    {
        Suplier::find($suplier->id)->update($request->except(['_token', '_method']));

        toast('Data berhasil diubah', 'success');

        return redirect()->route('master-data.suplier.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suplier $suplier)
    {
        Suplier::destroy($suplier->id);

        toast('Data berhasil dihapus', 'success');

        return redirect()->route('master-data.suplier.index');
    }
}
