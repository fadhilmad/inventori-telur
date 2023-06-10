@extends('layouts.app')

@section('title', 'Master Data - User')

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">

                <div class="card-tools">
                    <a href="{{ route('master-data.user.create') }}" class="btn btn-primary" dusk="btn-user-create">
                        <i class="fas fa-plus"></i> Buat
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th style="width: 10px" class="text-center">#</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Level Akses</th>
                            <th style="width: 20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->count() > 0)
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-start">{{ $user->name }}</td>
                                    <td class="text-center">{{ $user->username }}</td>
                                    <td class="text-center">{{ $user->role }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('master-data.user.edit', $user->id) }}"
                                            class="btn btn-default btn-sm" dusk="btn-user-edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('master-data.user.destroy', $user->id) }}"
                                            class="btn btn-danger btn-sm" data-confirm-delete="true" dusk="btn-user-delete">
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
