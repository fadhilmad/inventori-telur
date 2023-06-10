@extends('layouts.app')

@section('title', 'Buat Retur')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <form class="form-horizontal" method="POST" action="{{ route('transaksi.retur.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control @error('tanggal_retur') is-invalid @enderror"
                                        id="inputPassword3" placeholder="Tanggal" name="tanggal_retur"
                                        value="{{ old('tanggal_retur') }}">
                                    @error('tanggal_retur')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Alasan</label>
                                <div class="col-sm-10">
                                    <textarea name="alasan" class="form-control @error('alasan') is-invalid @enderror" rows="5">{{ old('alasan') }}</textarea>
                                    @error('alasan')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info" dusk="btn-tretur-store">Simpan</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
            <!-- /.row -->
    </section>
@endsection
