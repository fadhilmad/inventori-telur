@extends('layouts.app')

@section('title', 'Ubah Retur')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <form class="form-horizontal" method="POST" action="{{ route('transaksi.retur.update', $retur->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('tanggal_retur') is-invalid @enderror"
                                        id="inputPassword3" placeholder="Nama" name="tanggal_retur"
                                        value="{{ $retur->tanggal_retur }}">
                                    @error('tanggal_retur')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Alasan</label>
                                <div class="col-sm-10">
                                    <textarea name="alasan" class="form-control @error('alasan') is-invalid @enderror" rows="5">{{ $retur->alasan }}</textarea>
                                    @error('alasan')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info" dusk="btn-tretur-update">Simpan</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
            <!-- /.row -->
    </section>
@endsection
