@extends('layouts.app')

@section('title', 'Master Data - Telur')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">

                <div class="card-tools">
                    <a href="{{ route('master-data.telur.create') }}" class="btn btn-primary" dusk="btn-telur-create">
                        <i class="fas fa-plus"></i> Tambah Telur
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th style="width: 10px" class="text-center">#</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Satuan Besar</th>
                            <th class="text-center">Isi Satuan Kecil</th>
                            <th class="text-center">Satuan Kecil</th>
                            <th style="width: 20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($telurs->count() > 0)
                            @foreach ($telurs as $key => $telur)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-start">{{ $telur->name }}</td>
                                    <td class="text-center">{{ $telur->satuanBesar?->name }}</td>
                                    <td class="text-center">{{ $telur->isi_satuan_kecil }}</td>
                                    <td class="text-center">{{ $telur->satuanKecil?->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('master-data.telur.edit', $telur->id) }}"
                                            class="btn btn-default btn-sm" dusk="btn-telur-edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('master-data.telur.destroy', $telur->id) }}"
                                            class="btn btn-danger btn-sm" data-confirm-delete="true"
                                            dusk="btn-telur-delete">
                                            <i class="fas fa-trash" data-confirm-delete="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="6">Belum ada data.</td>
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
