@extends('layouts.template_default')
@section('title', 'Permintaan Order')
@section('order_request', 'active')
@section('content')

<style>
    button:disabled {
        background-color: #6c757d !important;
        border-color: #6c757d !important;
        cursor: not-allowed;
    }
</style>

<div class="content-wrapper">
    @include('sweetalert::alert')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Permintaan Order</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="Table" class="table table-bordered table-striped table-sm text-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Dibuat</th>
                                            <th>Kode Produk</th>
                                            <th>Operator</th>
                                            <th>Nama Komponen</th>
                                            <th>Jumlah</th>
                                            <th>Jenis</th>
                                            <th>Tanggal Dedline</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $request)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ \Carbon\Carbon::parse($request->created_at)->translatedFormat('d F Y') }}</td>
                                                <td>{{ $request->komponen->kode_komponen }}</td>
                                                <td>{{ $request->operator->name }}</td>
                                                <td>{{ $request->komponen->nama_komponen }}</td>
                                                <td>{{ $request->jumlah }}</td>
                                                <td>{{ $request->jenis_komponen }}</td>
                                                <td>{{ \Carbon\Carbon::parse($request->tanggal_dedline)->translatedFormat('d F Y') }}</td>
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
                                                    <button
                                                        class="btn btn-primary btn-sm open-modal"
                                                        data-id="{{ $request->komponen->id }}"
                                                        data-kode="{{ $request->komponen->kode_komponen }}"
                                                        data-nama="{{ $request->komponen->nama_komponen }}"
                                                        data-operator="{{ $request->operator->name }}"
                                                        data-jumlah="{{ $request->jumlah }}"
                                                        data-jenis="{{ $request->jenis_komponen }}"
                                                        data-dedline="{{ $request->tanggal_dedline }}"

                                                    >
                                                        <i class="fa fa-plus"></i> Finish Hasil
                                                    </button>
                                                </td>
                                            </tr>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('pages.admin.wip_komponen.create')

@endsection
