@extends('layouts.template_default')
@section('title', 'Permintaan Komponen')
@section('order_request', 'active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Permintaan Komponen</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Permintaan Komponen</li>
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
                                    <i class="fa fa-plus"></i> Tambah Permintaan
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Table" class="table table-bordered table-striped table-sm text-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Kode Produk</th>
                                                <th>Operator</th>
                                                <th>Nama Komponen</th>
                                                <th>Jumlah</th>
                                                <th>Jenis</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $request)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($request->tanggal)->translatedFormat('d F Y') }}</td>
                                                    <td>{{ $request->kode_product }}</td>
                                                    <td>{{ $request->operator->name }}</td>
                                                    <td>{{ $request->nama_komponen }}</td>
                                                    <td>{{ $request->jumlah }}</td>
                                                    <td>{{ $request->jenis_komponen }}</td>
                                                    <td>
                                                        @if ($request->status == 'pending')
                                                            <span class="badge badge-warning">Pending</span>
                                                        @elseif ($request->status == 'selesai')
                                                            <span class="badge badge-success">Selesai</span>
                                                        @elseif ($request->status == 'diproses')
                                                            <span class="badge badge-primary">Proses</span>
                                                        @else
                                                            <span class="badge badge-secondary">Null</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <!-- Tombol Edit -->
                                                        <a href="#" class="btn btn-warning btn-sm mx-2" data-toggle="modal" data-target="#modal-edit{{$request->id}}">
                                                            <i class="fa fa-pen"></i>
                                                        </a>


                                                        <!-- Tombol Hapus -->
                                                        <form action="{{ route('order_requests.destroy', $request->id) }}" method="POST" style="display:inline;" class="delete_confirm">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-xs">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

                                                @include('pages.admin.order_requests.edit', ['request' => $request])
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

    @include('pages.admin.order_requests.create')
@endsection
