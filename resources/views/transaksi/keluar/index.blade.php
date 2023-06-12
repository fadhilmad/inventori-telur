@extends('layouts.app')

@section('title', 'Transaksi Keluar')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">

                <div class="card-tools">

                    <a href="{{ route('transaksi.keluar.create') }}" class="btn btn-primary" dusk="btn-tkeluar-create">
                        <i class="fas fa-plus"></i> Buat Transaksi
                    </a>
                    <button type="button" class="btn btn-default ml-2" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-file-pdf"></i> Laporan
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th style="width: 10px" class="text-center">#</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Tujuan</th>
                            <th class="text-center">Status</th>
                            <th style="width: 20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($keluar->count() > 0)
                            @foreach ($keluar as $key => $row)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $row->tanggal_keluar }}</td>
                                    <td class="text-center">{{ $row->tujuan }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge @if ($row->status == 'belum') bg-secondary @else bg-success @endif">
                                            {{ \Str::upper($row->status) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('transaksi.keluar.show', $row->id) }}"
                                            class="btn btn-primary btn-sm" dusk="btn-tkeluar-show">
                                            <i class="fas fa-search"></i>
                                        </a>
                                        @if ($row->status == 'belum')
                                            <a href="{{ route('transaksi.keluar.edit', $row->id) }}"
                                                class="btn btn-default btn-sm" dusk="btn-tkeluar-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('transaksi.keluar.destroy', $row->id) }}"
                                                class="btn btn-danger btn-sm" data-confirm-delete="true"
                                                dusk="btn-tkeluar-delete">
                                                <i class="fas fa-trash" data-confirm-delete="true"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('transaksi.keluar.print', $row->id) }}"
                                                class="btn btn-default btn-sm" dusk="btn-tkeluar-show">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="5">Belum ada data.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    <div class="modal fade" id="modal-default" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('transaksi.keluar.laporan') }}" id="laporan-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Laporan Pengeluaran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tanggal Awal</label>
                            <input type="date" name="start" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Akhir</label>
                            <input type="date" name="end" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Lihat</button>
                    </div>
                </div>
            </form>

        </div>

    </div>
@endsection
