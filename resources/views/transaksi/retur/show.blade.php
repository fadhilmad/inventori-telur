@extends('layouts.app')

@section('title', 'Detail Retur')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="@if ($retur->status == 'belum') col-lg-4 @else col-lg-12 @endif">
                <div class="card card-primary card-outline">
                    <form class="form-horizontal" method="POST" action="{{ route('transaksi.retur.selesai', $retur->id) }}"
                        id="form-retur-stok">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('tanggal_retur') is-invalid @enderror"
                                        id="inputPassword3" placeholder="Nama" name="tanggal_retur"
                                        value="{{ $retur->tanggal_retur }}" disabled>
                                    @error('tanggal_retur')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Alasan</label>
                                <div class="col-sm-10">
                                    <textarea name="alasan" disabled class="form-control @error('alasan') is-invalid @enderror" rows="5">{{ $retur->alasan }}</textarea>
                                    @error('tujuan')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            @if ($retur->status == 'belum')
                                <button class="btn btn-primary btn-block" type="button" onclick="confirmSelesai()">
                                    <i class="fas fa-check"></i> Selesai
                                </button>
                            @endif
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>

            @if ($retur->status == 'belum')
                <div class="col-lg-8">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="card-title">Item Transaksi</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('transaksi.retur.detail.store', ['retur' => $retur->id]) }}"
                                method="post">
                                @csrf
                                <input type="hidden" name="transaksi_retur_id" value="{{ $retur->id }}">
                                <input type="hidden" name="telur_id">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="">Telur Tersedia</label>
                                            <select name="telur_id"
                                                class="form-control @error('telur_stok_id') is-invalid @enderror">
                                                <option value="">-- Pilih Telur ---</option>
                                                @foreach ($telurs->sortBy('name') as $telur)
                                                    <option value="{{ $telur->telur_id }}" data-ready="{{ $telur->ready }}">
                                                        {{ $telur->name }}
                                                        ({{ $telur->ready }} {{ $telur->satuan_kecil }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('telur_stok_id')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="">Jumlah</label>
                                            <input type="number" min="1" name="qty"
                                                class="form-control @error('qty') is-invalid @enderror">
                                            @error('qty')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <label for="" style="color: white">Button</label> <br>
                                        <button class="btn btn-primary  btn-icon" type="submit">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            @endif


            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">Daftar Telur</div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px" class="text-center">#</th>
                                    <th class="text-center" style="width: 70%">Telur</th>
                                    <th class="text-center">Sub Total</th>
                                    <th style="width: 10%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($details->count() > 0)
                                    @foreach ($details as $key => $detail)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-start">{{ $detail->name }}
                                            </td>
                                            <td class="text-center">
                                                {{ $detail->qty }} {{ $detail->satuan_kecil }}
                                            </td>
                                            <td class="text-center">
                                                @if ($retur->status == 'belum')
                                                    <a href="{{ route('transaksi.retur.detail.destroy', ['retur' => $retur->id, 'telur' => $detail->telur_id]) }}"
                                                        class="btn btn-danger btn-sm" data-confirm-delete="true"
                                                        dusk="btn-telur-delete">
                                                        <i class="fas fa-trash" data-confirm-delete="true"></i>
                                                    </a>
                                                @endif
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
                </div>
            </div>
            <!-- /.row -->
    </section>
@endsection

@section('js-custom')
    <script>
        $('select[name=telur_stok_id]').on('change', function(e) {
            var dataAttributes = $(this).find('option:selected').data();
            $('input[name=telur_id]').val(dataAttributes.telur)
            $('input[name=qty]').attr('max', dataAttributes.ready);
        })

        function confirmSelesai() {
            Swal.fire({
                title: 'Apakah anda yakin akan menyelesaikan transaksi ini?',
                text: "Transaksi yang sudah diselesaikan tidak dapat diubah",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-retur-stok').submit();
                }
            })
        }
    </script>

@endsection
