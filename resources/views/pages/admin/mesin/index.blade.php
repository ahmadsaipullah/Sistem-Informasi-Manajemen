@extends('layouts.template_default')
@section('title', 'Data Mesin')
@section('mesin', 'active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Mesin</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Data Mesin</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                                    <i class="fa fa-plus"></i> Tambah Mesin
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Table" class="table table-bordered table-striped table-sm text-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Kode Mesin</th>
                                                <th>Nama Mesin</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mesins as $mesin)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($mesin->created_at)->translatedFormat('d F Y') }}</td>
                                                    <td>{{ $mesin->kode_mesin }}</td>
                                                    <td>{{ $mesin->nama_mesin }}</td>
                                                    <td>
                                                        <!-- Tombol Edit -->
                                                        <a href="#" class="btn btn-warning btn-sm mx-2" data-toggle="modal" data-target="#modal-edit-{{ $mesin->id }}">
                                                            <i class="fa fa-pen"></i>
                                                        </a>

                                                        <!-- Tombol Hapus -->
                                                        <form action="{{ route('mesin.destroy', $mesin->id) }}" method="POST" style="display:inline;" class="delete_confirm">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                @include('pages.admin.mesin.edit', ['mesin' => $mesin])
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('pages.admin.mesin.create')
@endsection
