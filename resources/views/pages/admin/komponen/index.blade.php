@extends('layouts.template_default')
@section('title', 'Komponen Komponen')
@section('komponen', 'active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Komponen Komponen</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Komponen Komponen</li>
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
                                    <i class="fa fa-plus"></i> Tambah Komponen
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Table" class="table table-bordered table-striped table-sm text-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Kode Komponen</th>
                                                <th>Nama Komponen</th>
                                                <th>Stok</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($komponens as $request)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($request->created_at)->translatedFormat('d F Y') }}</td>
                                                    <td>{{ $request->kode_komponen }}</td>
                                                    <td>{{ $request->nama_komponen }}</td>
                                                    <td>{{ $request->stok }}</td>
                                                    <td>
                                                        <!-- Tombol Edit -->
                                                        <a href="#" class="btn btn-warning btn-sm mx-2" data-toggle="modal" data-target="#modal-edit-{{ $request->id }}">
                                                            <i class="fa fa-pen"></i>
                                                        </a>

                                                        <!-- Tombol Hapus -->
                                                        <form action="{{ route('komponen.destroy', $request->id) }}" method="POST" style="display:inline;" class="delete_confirm">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                @include('pages.admin.komponen.edit', ['request' => $request])
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

    @include('pages.admin.komponen.create')
@endsection
