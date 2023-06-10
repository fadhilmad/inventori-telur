@extends('layouts.app')

@section('title', 'Master Data - Satuan Besar')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">

                <div class="card-tools">
                    <a href="{{ route('master-data.satuan-besar.create') }}" class="btn btn-primary" dusk="btn-satuan-create">
                        <i class="fas fa-plus"></i> Tambah Satuan
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th style="width: 10px" class="text-center">#</th>
                            <th class="text-center">Satuan Besar</th>
                            <th style="width: 20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($satuans->count() > 0)
                            @foreach ($satuans as $key => $satuan)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-start">{{ $satuan->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('master-data.satuan-besar.edit', $satuan->id) }}"
                                            class="btn btn-default btn-sm" dusk="btn-satuan-edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('master-data.satuan-besar.destroy', $satuan->id) }}"
                                            class="btn btn-danger btn-sm" data-confirm-delete="true"
                                            dusk="btn-satuan-delete">
                                            <i class="fas fa-trash" data-confirm-delete="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="3">Belum ada data.</td>
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
