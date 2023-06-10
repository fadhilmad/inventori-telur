@extends('layouts.app')

@section('title', 'Buat Transaksi Masuk')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <form class="form-horizontal" method="POST" action="{{ route('transaksi.masuk.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                        id="inputPassword3" placeholder="Nama" name="tanggal_masuk"
                                        value="{{ old('tanggal_masuk') }}">
                                    @error('tanggal_masuk')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Suplier</label>
                                <div class="col-sm-10">
                                    <select name="suplier_id"
                                        class="form-control @error('suplier_id') is-invalid @enderror">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($suplier->sortBy('name') as $key => $row)
                                            <option value="{{ $row->id }}"
                                                {{ old('suplier_id') == $row->id ? 'selected' : '' }}>
                                                {{ $row->name }}</option>
                                        @endforeach
                                        </option>
                                    </select>
                                    @error('suplier_id')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info" dusk="btn-tmasuk-store">Simpan</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
            <!-- /.row -->
    </section>
@endsection
