@extends('layouts.template_default')
@section('title', 'Permintaan Wip Komponen')
@section('wipkomponen', 'active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Permintaan Wip Komponen</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Permintaan Wip Komponen</li>
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
                                                @if(auth()->user()->level_id == 1)
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
                                                <td>{{ $request->orderRequest->komponen->kode_komponen }}</td>
                                                <td>{{ $request->orderRequest->komponen->nama_komponen }}</td>
                                                <td>{{ $request->orderRequest->operator->name }}</td>
                                                <td>{{ $request->orderRequest->jenis_komponen }}</td>
                                                <td>{{ $request->lokasi }}</td>
                                                <td>{{ \Carbon\Carbon::parse($request->orderRequest->tanggal_dedline)->format('d/m/Y') }}</td>
                                                <td>{{ $request->orderRequest->jumlah }}</td>
                                                <td>{{ \Carbon\Carbon::parse($request->tanggal_out)->format('d/m/Y') }}</td>
                                                <td>{{ $request->jumlah_out }}</td>
                                                <td class="text-center align-middle">
                                                    <span class="badge badge-success">{{ $request->status }}</span>
                                                </td>

                                                @if(auth()->user()->level_id == 1)
                                                    <td>
                                                        {{-- <!-- Tombol Edit -->
                                                        <a href="#" class="btn btn-warning btn-sm mx-2" data-toggle="modal" data-target="#modal-edit-{{ $request->id }}">
                                                            <i class="fa fa-pen"></i>
                                                        </a>
 --}}

                                                        <!-- Tombol Hapus -->
                                                        <form action="{{ route('wip_komponen.destroy', $request->id) }}" method="POST" style="display:inline;" class="delete_confirm">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
@endif
                                                </tr>

                                                @include('pages.admin.wip_komponen.edit', ['request' => $request])
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

@endsection
