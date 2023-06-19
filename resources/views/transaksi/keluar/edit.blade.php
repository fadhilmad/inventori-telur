@extends('layouts.app')

@section('title', 'Ubah Transaksi')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <form class="form-horizontal" method="POST" action="{{ route('transaksi.keluar.update', $keluar->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control @error('tanggal_keluar') is-invalid @enderror"
                                        id="inputPassword3" placeholder="Nama" name="tanggal_keluar"
                                        value="{{ $keluar->tanggal_keluar }}">
                                    @error('tanggal_keluar')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="inputPassword3" placeholder="nama" name="nama" value="{{ $keluar->nama }}">
                                    @error('nama')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Tujuan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('tujuan') is-invalid @enderror"
                                        id="inputPassword3" placeholder="Tujuan" name="tujuan"
                                        value="{{ $keluar->tujuan }}">
                                    @error('tujuan')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info" dusk="btn-tkeluar-update">Simpan</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
            <!-- /.row -->
    </section>
@endsection
