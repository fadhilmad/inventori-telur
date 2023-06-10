@extends('layouts.app')

@section('title', 'Stok Telur')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px" class="text-center">#</th>
                            <th class="text-center">Uraian</th>
                            <th class="text-center">Tersedia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($telur as $key => $row)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-start">{{ $row->name }}</td>
                            </tr>
                            @foreach ($stok->where('name', $row->name) as $keyStok => $value)
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-start" style="padding-left: 35px">
                                        - Satuan : {{ $value->satuan_besar }}
                                        @ {{ $value->isi_satuan_kecil }}{{ $value->satuan_kecil }}
                                    </td>
                                    <td class="text-center">{{ number_format($value->ready) }} {{ $value->satuan_kecil }}
                                    </td>
                                </tr>
                            @endforeach
                            {{-- {{ dump($stok->where('name', $row->name)) }} --}}
                        @endforeach
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
