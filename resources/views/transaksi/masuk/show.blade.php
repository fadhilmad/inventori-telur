@extends('layouts.app')

@section('title', 'Detail Transaksi Masuk')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="@if ($masuk->insert_stok == 'belum') col-lg-4 @else col-lg-12 @endif">
                <div class="card card-primary card-outline">
                    <form class="form-horizontal" method="POST"
                        action="{{ route('transaksi.masuk.insert-stok', $masuk->id) }}" id="form-masuk-stok">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                        id="inputPassword3" placeholder="Nama" name="tanggal_masuk"
                                        value="{{ $masuk->tanggal_masuk }}" disabled>
                                    @error('tanggal_masuk')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Suplier</label>
                                <div class="col-sm-10">
                                    <select name="suplier_id" class="form-control @error('suplier_id') is-invalid @enderror"
                                        disabled>
                                        <option value="">-- Pilih --</option>
                                        @foreach ($suplier->sortBy('name') as $key => $row)
                                            <option value="{{ $row->id }}"
                                                {{ $masuk->suplier_id == $row->id ? 'selected' : '' }}>
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
                            @if ($masuk->insert_stok == 'belum')
                                <button class="btn btn-primary btn-block" type="button" onclick="confirmStok()">
                                    <i class="fas fa-check"></i> Tambahkan ke stok
                                </button>
                            @endif
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>

            @if ($masuk->insert_stok == 'belum')
                <div class="col-lg-8">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="card-title">Item Transaksi</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('transaksi.masuk.detail.store', ['masuk' => $masuk->id]) }}"
                                method="post">
                                @csrf
                                <input type="hidden" name="transaksi_masuk_id" value="{{ $masuk->id }}">
                                <input type="hidden" name="satuan_besar">
                                <input type="hidden" name="satuan_kecil">
                                <input type="hidden" name="isi_satuan_kecil">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <label for="">Telur</label>
                                            <select name="telur_id"
                                                class="form-control @error('telur_id') is-invalid @enderror">
                                                <option value="">-- Pilih Telur ---</option>
                                                @foreach ($telurs->sortBy('name') as $telur)
                                                    <option value="{{ $telur->id }}"
                                                        data-satuan-besar="{{ $telur->satuanBesar->name }}"
                                                        data-satuan-kecil="{{ $telur->satuanKecil->name }}"
                                                        data-isi-satuan="{{ $telur->isi_satuan_kecil }}">
                                                        {{ $telur->name }} ( 1 {{ $telur->satuanBesar->name }} x
                                                        {{ $telur->isi_satuan_kecil }} {{ $telur->satuanKecil->name }} )
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('telur_id')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="">Jumlah</label>
                                            <input type="number" min="1" name="qty_satuan_besar"
                                                class="form-control @error('qty_satuan_besar') is-invalid @enderror">
                                            @error('qty_satuan_besar')
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
                                @if ($masuk->details->count() > 0)
                                    @foreach ($masuk->details as $key => $detail)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td class="text-start">{{ $detail->telur->name }}
                                                ({{ $detail->qty_satuan_besar }} {{ $detail->satuan_besar }}
                                                <strong>x</strong>
                                                {{ $detail->isi_satuan_kecil }} {{ $detail->satuan_kecil }})
                                            </td>
                                            <td class="text-center">
                                                {{ $detail->total }} {{ $detail->satuan_kecil }}
                                            </td>
                                            <td class="text-center">
                                                @if ($masuk->insert_stok == 'belum')
                                                    <a href="{{ route('transaksi.masuk.detail.destroy', ['masuk' => $masuk->id, 'detail' => $detail->id]) }}"
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
        $('select[name=telur_id]').on('change', function(e) {
            var dataAttributes = $(this).find('option:selected').data();
            $('input[name=satuan_besar]').val(dataAttributes.satuanBesar)
            $('input[name=satuan_kecil]').val(dataAttributes.satuanKecil)
            $('input[name=isi_satuan_kecil]').val(dataAttributes.isiSatuan)
        })

        function confirmStok() {
            Swal.fire({
                title: 'Apakah anda yakin akan menambahkan transaksi ini ke stok?',
                text: "Transaksi yang sudah ditambahkan tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-masuk-stok').submit();
                }
            })
        }
    </script>

@endsection
