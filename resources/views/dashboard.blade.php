@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="row">
            @if (Auth::user()->role == 'admin')
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $telur }}</h3>

                            <p>Jenis Telur</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cubes"></i>
                        </div>
                        <a href="{{ route('master-data.telur.index') }}" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            @endif
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $tMasuk }}</h3>

                        <p>Transaksi Masuk</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-download-outline"></i>
                    </div>
                    <a href="{{ route('transaksi.masuk.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $tKeluar }}</h3>

                        <p>Transaksi Keluar</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-upload-outline"></i>
                    </div>
                    <a href="{{ route('transaksi.keluar.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
