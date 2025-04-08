@extends('layouts.template_default')
@section('title', 'Hasil Produksi')
@section('hasil-produksi', 'active')
@section('content')
    <div class="content-wrapper">
        @include('sweetalert::alert')

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Hasil Produksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Hasil Produksi</li>
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
                                <a href="{{ route('hasil-produksi.export-pdf') }}" class="btn btn-danger mb-3">
                                    <i class="fas fa-file-pdf"></i> Export PDF
                                </a>

                                <div class="table-responsive">
                                    <table id="Table" class="table table-bordered table-striped table-sm text-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Product</th>
                                                <th>Nama Komponen</th>
                                                <th>Operator</th>
                                                <th>Jam</th>
                                                <th>Shift</th>
                                                <th>Hasil</th>
                                                <th>Target</th>
                                                <th>Hambatan</th>
                                                @if(auth()->user()->level_id == 1)
                                                    <th>Aksi</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($hasilProduksis as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->produksi->orderRequest->komponen->kode_komponen ?? '-' }}</td>
                                                <td>{{ $item->produksi->orderRequest->komponen->nama_komponen ?? '-' }}</td>
                                                <td>{{ $item->produksi->orderRequest->operator->name ?? '-' }}</td>
                                                <td>{{ $item->jam }}</td>
                                                <td>{{ $item->shift }}</td>
                                                <td>{{ $item->hasil }}</td>
                                                <td>{{ $item->target }}</td>
                                                <td>{{ $item->hambatan }}</td>
                                                @if(auth()->user()->level_id == 1)
                                                    <td>
                                                        <form action="{{ route('hasil-produksi.destroy', $item->id) }}" method="POST" style="display:inline;" class="delete_confirm">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                            {{-- @include('pages.admin.hasil-produksi.edit', ['item' => $item]) --}}
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
