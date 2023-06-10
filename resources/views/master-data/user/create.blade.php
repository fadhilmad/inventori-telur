@extends('layouts.app')

@section('title', 'Buat User')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <form class="form-horizontal" method="POST" action="{{ route('master-data.user.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="inputPassword3" placeholder="Nama" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        id="inputPassword3" placeholder="Username" name="username"
                                        value="{{ old('username') }}">
                                    @error('username')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Level Akses</label>
                                <div class="col-sm-10">
                                    <select name="role" class="form-control @error('role') is-invalid @enderror">
                                        <option value="">-- Pilih --</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan
                                        </option>
                                    </select>
                                    @error('role')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="inputPassword3" placeholder="Password" name="password">
                                    @error('password')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                                <div class="col-sm-10">
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="inputPassword3" placeholder="Konfirmasi Password" name="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info" dusk="btn-user-store">Simpan</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>
            <!-- /.row -->
    </section>
@endsection
