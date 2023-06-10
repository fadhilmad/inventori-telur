@extends('layouts.app')

@section('title', 'Retur')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">

                <div class="card-tools">
                    <a href="{{ route('transaksi.retur.create') }}" class="btn btn-primary" dusk="btn-tretur-create">
                        <i class="fas fa-plus"></i> Buat Retur
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th style="width: 10px" class="text-center">#</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Alasan</th>
                            <th class="text-center">Status</th>
                            <th style="width: 20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($retur->count() > 0)
                            @foreach ($retur as $key => $row)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $row->tanggal_retur }}</td>
                                    <td class="text-center">{{ \Str::limit($row->alasan, 100, '...') }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge @if ($row->status == 'belum') bg-secondary @else bg-success @endif">
                                            {{ \Str::upper($row->status) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('transaksi.retur.show', $row->id) }}"
                                            class="btn btn-primary btn-sm" dusk="btn-tretur-show">
                                            <i class="fas fa-search"></i>
                                        </a>
                                        @if ($row->status == 'belum')
                                            <a href="{{ route('transaksi.retur.edit', $row->id) }}"
                                                class="btn btn-default btn-sm" dusk="btn-tretur-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('transaksi.retur.destroy', $row->id) }}"
                                                class="btn btn-danger btn-sm" data-confirm-delete="true"
                                                dusk="btn-tretur-delete">
                                                <i class="fas fa-trash" data-confirm-delete="true"></i>
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
@endsection
