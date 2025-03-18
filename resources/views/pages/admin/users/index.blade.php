@extends('layouts.template_default')
@section('title', 'Halaman Admin')
@section('admin','active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Halaman Admin</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Halaman Admin</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-primary btn-sm" href="{{route('admin.create')}}">
                                    <i class="fa fa-plus"></i> Tambah Admin
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Table" class="table table-bordered table-striped table-sm text-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>NIP</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($admins as $admin)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $admin->name }}</td>
                                                    <td>{{ $admin->nip }}</td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>{{ $admin->Level->level}}</td>
                                                    <td class="text-center">
                                                        @if ($admin->image)
                                                            <img src="{{ Storage::url($admin->image) }}" alt="gambar"
                                                            width="50px" height="50px" style="object-fit: cover; border-radius: 50%;">
                                                        @else
                                                            <img src="{{ asset('assets/img/user_default.png') }}" alt="image"
                                                            width="50px" height="50px" style="object-fit: cover; border-radius: 50%;">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.edit', $admin->id) }}"
                                                            class="btn btn-warning btn-xs">
                                                            <i class="fa fa-pen"></i>
                                                        </a>
                                                        <form action="{{ route('admin.destroy', $admin->id) }}" method="post"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger btn-xs delete_confirm" type="submit">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                            <tr>
                                                <td colspan="7" class="text-center p-3">Data Kosong</td>
                                             </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

<style>
    /* Hover tombol outline biru */
    .btn:hover {
        outline: 2px solid blue;
    }

    /* Mengecilkan tabel */
    .table-sm th,
    .table-sm td {
        font-size: 12px;
        padding: 5px;
    }

    /* Responsif */
    @media (max-width: 768px) {
        .table-sm th,
        .table-sm td {
            font-size: 10px;
            padding: 3px;
        }

        .table-sm img {
            width: 40px;
            height: 40px;
        }

        .btn-xs {
            font-size: 10px;
            padding: 2px 4px;
        }
    }
</style>
