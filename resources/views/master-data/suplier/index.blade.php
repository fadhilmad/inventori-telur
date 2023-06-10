@extends('layouts.app')

@section('title', 'Master Data - Suplier')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">

                <div class="card-tools">
                    <a href="{{ route('master-data.suplier.create') }}" class="btn btn-primary" dusk="btn-suplier-create">
                        <i class="fas fa-plus"></i> Tambah Suplier
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th style="width: 10px" class="text-center">#</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Kontak</th>
                            <th style="width: 20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($supliers->count() > 0)
                            @foreach ($supliers as $key => $suplier)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-start">{{ $suplier->name }}</td>
                                    <td class="text-start">{{ $suplier->address }}</td>
                                    <td class="text-start">{{ $suplier->contact }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('master-data.suplier.edit', $suplier->id) }}"
                                            class="btn btn-default btn-sm" dusk="btn-suplier-edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('master-data.suplier.destroy', $suplier->id) }}"
                                            class="btn btn-danger btn-sm" data-confirm-delete="true"
                                            dusk="btn-suplier-delete">
                                            <i class="fas fa-trash" data-confirm-delete="true"></i>
                                        </a>
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
