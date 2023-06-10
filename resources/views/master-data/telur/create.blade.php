@extends('layouts.app')

@section('title', 'Tambah Telur')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <form class="form-horizontal" method="POST" action="{{ route('master-data.telur.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="inputPassword3" placeholder="Nama" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Satuan Besar</label>
                                <div class="col-sm-10">
                                    <select name="satuan_besar_id"
                                        class="form-control @error('satuan_besar_id') is-invalid @enderror">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($satuanBesar->sortBy('name') as $key => $besar)
                                            <option value="{{ $besar->id }}"
                                                {{ old('satuan_besar_id') == $besar->id ? 'selected' : '' }}>
                                                {{ $besar->name }}</option>
                                        @endforeach
                                        </option>
                                    </select>
                                    @error('satuan_besar_id')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Isi Satuan Kecil</label>
                                <div class="col-sm-10">
                                    <input type="number"
                                        class="form-control @error('isi_satuan_kecil') is-invalid @enderror"
                                        id="inputPassword3" placeholder="Isi Satuan Kecil" name="isi_satuan_kecil"
                                        value="{{ old('isi_satuan_kecil') }}">
                                    @error('isi_satuan_kecil')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Satuan Kecil</label>
                                <div class="col-sm-10">
                                    <select name="satuan_kecil_id"
                                        class="form-control @error('satuan_kecil_id') is-invalid @enderror">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($satuanKecil->sortBy('name') as $key => $besar)
                                            <option value="{{ $besar->id }}"
                                                {{ old('satuan_kecil_id') == $besar->id ? 'selected' : '' }}>
                                                {{ $besar->name }}</option>
                                        @endforeach
                                        </option>
                                    </select>
                                    @error('satuan_kecil_id')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info" dusk="btn-telur-store">Simpan</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
            <!-- /.row -->
    </section>
@endsection
