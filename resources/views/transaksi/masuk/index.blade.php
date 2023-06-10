@extends('layouts.app')

@section('title', 'Transaksi Masuk')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">

                <div class="card-tools">
                    <a href="{{ route('transaksi.masuk.create') }}" class="btn btn-primary" dusk="btn-tmasuk-create">
                        <i class="fas fa-plus"></i> Buat Transaksi
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th style="width: 10px" class="text-center">#</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Suplier</th>
                            <th class="text-center">Ditambahkan <br> ke Stok </th>
                            <th style="width: 20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($masuk->count() > 0)
                            @foreach ($masuk as $key => $row)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $row->tanggal_masuk }}</td>
                                    <td class="text-center">{{ $row->suplier?->name }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge @if ($row->insert_stok == 'belum') bg-secondary @else bg-success @endif">
                                            {{ \Str::upper($row->insert_stok) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('transaksi.masuk.show', $row->id) }}"
                                            class="btn btn-primary btn-sm" dusk="btn-tmasuk-show">
                                            <i class="fas fa-search"></i>
                                        </a>
                                        @if ($row->insert_stok == 'belum')
                                            <a href="{{ route('transaksi.masuk.edit', $row->id) }}"
                                                class="btn btn-default btn-sm" dusk="btn-tmasuk-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('transaksi.masuk.destroy', $row->id) }}"
                                                class="btn btn-danger btn-sm" data-confirm-delete="true"
                                                dusk="btn-tmasuk-delete">
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
