@extends('layouts.template_default')
@section('title', 'Hasil Wip Komponen')
@section('hasilwip', 'active')
@section('content')
<div class="content-wrapper">
    @include('sweetalert::alert')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hasil Wip Komponen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Hasil Wip Komponen</li>
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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="Table" class="table table-bordered table-striped table-sm text-sm">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Kode Produk</th>
                                            <th rowspan="2">Nama Komponen</th>
                                            <th rowspan="2">Operator</th>
                                            <th rowspan="2">Jenis Komponen</th>
                                            <th rowspan="2">Lokasi</th>
                                            <th colspan="2" class="text-center">In</th>
                                            <th colspan="2" class="text-center">Out</th>
                                            <th rowspan="2">Keterangan</th>
                                            @if(auth()->user()->level_id == 5)
                                            <th rowspan="2">Aksi</th>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Qty</th>
                                            <th>Tanggal</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wip_komponens as $request)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $request->orderRequest->komponen->kode_komponen ?? '-' }}</td>
                                                <td>{{ $request->orderRequest->komponen->nama_komponen ?? '-' }}</td>
                                                <td>{{ $request->orderRequest->operator->name ?? '-' }}</td>
                                                <td>{{ $request->orderRequest->jenis_komponen ?? '-' }}</td>
                                                <td>{{ $request->lokasi }}</td>
                                                <td>{{ \Carbon\Carbon::parse($request->orderRequest->tanggal_dedline)->format('d/m/Y') }}</td>
                                                <td>{{ $request->orderRequest->jumlah }}</td>
                                                <td>{{ \Carbon\Carbon::parse($request->tanggal_out)->format('d/m/Y') }}</td>
                                                <td>{{ $request->jumlah_out }}</td>
                                                <td class="text-center align-middle">
                                                    <span class="badge badge-success">{{ $request->status }}</span>
                                                </td>
@if(auth()->user()->level_id == 5)
                                                @php
    $sudahInput = \App\Models\HasilProduksi::where('produksi_id', $request->id)->exists();
@endphp

                                                <td>
                                                    @if (!$sudahInput)
                                                    <button
                                                    class="btn btn-primary btn-sm open-hasil"
                                                    data-id="{{ $request->id }}"
                                                    data-kode="{{ $request->orderRequest->komponen->kode_komponen ?? '-' }}"
                                                    data-nama="{{ $request->orderRequest->komponen->nama_komponen ?? '-' }}"
                                                    data-operator="{{ $request->orderRequest->operator->name ?? '-' }}"
                                                    data-jumlah="{{ $request->orderRequest->jumlah }}"
                                                    data-jenis="{{ $request->orderRequest->jenis_komponen }}"
                                                    data-dedline="{{ $request->orderRequest->tanggal_dedline }}"
                                                    data-lokasi="{{ $request->lokasi }}"
                                                    data-tanggalout="{{ $request->tanggal_out }}"
                                                    data-jumlahout="{{ $request->jumlah_out }}"
                                                >
                                                    <i class="fa fa-plus"></i> Finish Hasil
                                                </button>
                                                @else
                                                <button class="btn btn-secondary btn-sm" disabled>Sudah Diinput</button>
                                            @endif
                                                </td>
                                                @endif

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                @include('pages.admin.hasil-produksi.create')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
